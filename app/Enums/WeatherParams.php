<?php

namespace App\Enums;

enum WeatherParams: string
{
    case PRECIPITATION = 'precipitation';
    case AIR_TEMPERATURE = 'airTemperature';
    case CLOUD_COVER = 'cloudCover';
    case PRESSURE = 'pressure';
    case GUST = 'gust';
    case HUMIDITY = 'humidity';
    case VISIBILITY = 'visibility';
    case WATER_TEMPERATURE = 'waterTemperature';
    case WAVE_HEIGHT = 'waveHeight';
    case WAVE_PERIOD = 'wavePeriod';
    case WIND_SPEED = 'windSpeed';
    case WIND_DIRECTION = 'windDirection';

    public function description(): string
    {
        return match ($this) {
            self::PRECIPITATION => 'Mean precipitation in kg/m²/h = mm/h',
            self::AIR_TEMPERATURE => 'Air temperature in degrees celsius',
            self::CLOUD_COVER => 'Total cloud coverage in percent',
            self::PRESSURE => 'Air pressure in hPa',
            self::GUST => 'Wind gust in meters per second',
            self::HUMIDITY => 'Relative humidity in percent',
            self::VISIBILITY => 'Horizontal visibility in km',
            self::WATER_TEMPERATURE => 'Water temperature in degrees celsius (Specifically when using the source NOAA this parameter returns surface temperature which can also be on land)',
            self::WAVE_HEIGHT => 'Significant Height of combined wind and swell waves in meters',
            self::WAVE_PERIOD => 'Period of combined wind and swell waves in seconds',
            self::WIND_SPEED => 'Speed of wind at 10m above sea level in meters per second.',
            self::WIND_DIRECTION => 'Direction of wind at 10m above sea level. 0° indicates wind coming from north',
        };
    }

    public static function toString(): string
    {
        return implode(',', collect(self::cases())->map(fn($case) => $case->value)->toArray());
    }

    public static function getParamsWithDescriptions(): array
    {
        return array_map(fn ($param) => [$param->value => $param->description()], self::cases());
    }
}
