<?php

namespace App\Services;

use Symfony\Component\Routing\Exception\InvalidParameterException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;
use App\Models\Weather;
use App\Enums\BeaufortScale;
use App\Decorators\WeatherInfoDecorator;

class WeatherService
{
    protected string $apiEndpoint = 'https://api.stormglass.io/forecast?lat={lat}&lng={lng}&start={start}&source=sg';

    public function getWeatherData($latitude, $longitude): WeatherInfoDecorator
    {
        $cacheKey = md5(config('services.weather_info.cache_prefix') . $latitude . ',' . $longitude);
        // Cache::rememberForever(md5(rand()), fn () => gzcompress(json_encode(cache($cacheKey . '::rawData'))));

        // dd(
        //     mb_strlen(json_encode(cache($cacheKey))),
        //     mb_strlen(gzcompress(json_encode(cache($cacheKey)))),
        //     mb_strlen(gzcompress(serialize(cache($cacheKey)))),
        //     mb_strlen(gzdeflate(json_encode(cache($cacheKey)))),
        //     mb_strlen(gzdeflate(serialize(cache($cacheKey)))),
        //     gzcompress(json_encode(cache($cacheKey))),
        //     gzcompress(serialize(cache($cacheKey))),
        //     json_decode(gzuncompress(gzcompress(json_encode(cache($cacheKey))))),
        //     json_decode(gzinflate(gzdeflate(json_encode(cache($cacheKey))))), // compresses approximately 20 times
        // );

        cache()->forget($cacheKey);


        $weatherData = config('services.weather_info.cache')
            ? Cache::remember($cacheKey, now()->diffInSeconds(now()->endOfHour()), function () use ($latitude, $longitude) {
                return $this->getWeatherDataFromDatabaseOrApi($latitude, $longitude);
            })
            : $this->getWeatherDataFromDatabaseOrApi($latitude, $longitude);

        return new WeatherInfoDecorator($weatherData);
    }

    protected function getWeatherDataFromDatabaseOrApi($latitude, $longitude): array
    {
        if (env('APP_DEBUG') && env('APP_ENV') == 'local' && (!$latitude || !$longitude)) {
            $latitude = 37.36883;
            $longitude = -122.03635;
        }

        if (!$latitude || !$longitude) {
            throw new InvalidParameterException('Latitude and longitude cannot be null');
        }

        $today = now()->toDateString();
        $weatherData = Weather::query()
            ->where('latitude', $latitude)
            ->where('longitude', $longitude)
            ->where('date', '>=', now()->subDays(7)->toDateString())
            ->orderBy('date', 'desc')
            ->get();

        $todayData = $weatherData->firstWhere('date', $today);

        if ($weatherData->isEmpty() || !$todayData) {
            return $this->fetchAndStoreWeatherData($latitude, $longitude);
        }

        return $this->formatWeatherData($todayData->toArray());
    }

    protected function fetchAndStoreWeatherData($latitude, $longitude): array
    {

        try {
            $cacheKey = md5(config('services.weather_info.cache_prefix') . $latitude . ',' . $longitude) . '::rawData';

            $response = Cache::remember($cacheKey, now()->diffInSeconds(now()->endOfDay()), function () use ($latitude, $longitude) {
                $apiUrl = strtr($this->apiEndpoint, [
                    '{lat}' => $latitude,
                    '{lng}' => $longitude,
                    '{start}' => now()->startOfDay()->toDateTimeString(),
                ]);

                $response = Http::withHeader('Authorization', config('services.weather_info.api_key.stormglass'))
                    ->get($apiUrl)
                    ->json();

                return gzcompress(json_encode($response)); // compresses approximately 20 times
            });

            $weatherData = collect(data_get(json_decode(gzuncompress($response), JSON_OBJECT_AS_ARRAY), 'hours'))
                ->groupBy(fn ($hour) => Carbon::parse($hour['time'])->toDateString())
                ->map(fn ($hours, $date) => [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'date' => $date,
                    'hours' => $hours->mapWithKeys(fn ($params, $hour) => [$hour => collect($params)->map(fn ($value, $param) => data_get($value, '0.value'))->filter()]),
                ]);

            Weather::upsert(
                $weatherData->toArray(),
                uniqueBy: ['latitude', 'longitude', 'date'],
                update: ['hours']
            );

            Weather::where('date', '<', now()->toDateString())->delete();

            return $this->formatWeatherData($weatherData->firstWhere('date', now()->toDateString()));
        } catch (\Exception $e) {
            Log::channel('weather')->error($e->getMessage(), ['exception' => $e]);
            if (env('APP_DEBUG')) {
                dd($e->getMessage(), $e->getLine(), $e->getFile(), $e->getTrace());
            }
            return [];
        }
    }

    protected function formatWeatherData(array $data): array
    {
        $data = collect($data);

        $aggregated = [];
        foreach (['airTemperature', 'waterTemperature', 'windSpeed', 'precipitation', 'pressure', 'humidity'] as $param) {
            foreach (['min', 'max', 'avg'] as $type) {
                $aggregated[$param][$type] = $data->get('hours')->$type($param);
            }
        }

        return [
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'date' => \Carbon\Carbon::parse($data['date']),
            'current' => data_get(
                $data,
                'hours.' . date('G')
            ),
            'aggregated' => $aggregated,
            'hours' => $data['hours']->toArray(),
            // 'windDescription' => BeaufortScale::getDescriptionByWindSpeed($aggregated['windSpeed']['avg'] * 3.6), // Конвертация из м/с в км/ч
        ];
    }
}
