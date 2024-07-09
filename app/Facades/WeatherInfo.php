<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class WeatherInfo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\WeatherService::class;
    }
}
