<?php

namespace App\Contracts;

use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Services\ColorService;
use App\Facades\IpInfo;
use App\Enums\BeaufortScale;

abstract class AbstractWeatherInfoDecorator
{
    protected array $weatherData;
    protected ?string $beaufortScale;


    protected Collection $current;
    public function getWeatherData(): array
    {
        return $this->weatherData;
    }

    public function setWeatherData(array $weatherData): void
    {
        $this->weatherData = $weatherData;
    }

    public function city(): ?string
    {
        return IpInfo::getCity();
    }

    public function country(): ?string
    {
        return IpInfo::getCountry();
    }

    public function get($key): mixed
    {
        return $this->current($key);
    }


    public function current($key = null): mixed
    {
        return data_get($this->weatherData, $key ? "current.{$key}" : 'current');
    }

    public function date($format = null): Carbon|string
    {
        return $format ? data_get($this->weatherData, 'date')?->format($format) : data_get($this->weatherData, 'date');
    }

    public function beaufortScale(): string
    {
        return BeaufortScale::tryFromName($this->beaufortScale);
    }

    public function backgroundColor(): string
    {
        return BeaufortScale::getColor($this->beaufortScale);
    }

    public function textColor(): string
    {
        return app(ColorService::class)->invertColor($this->backgroundColor());
    }

    public function chartData()
    {
        $hours = collect($this->weatherData['hours'] ?? []);

        return [
            ['AIR', ...$hours->pluck('airTemperature')],
            ['WATER', ...$hours->pluck('waterTemperature')],
            ['WIND', ...$hours->pluck('windSpeed')],
            ['HUMIDITY', ...$hours->pluck('humidity')],
        ];
    }
}
