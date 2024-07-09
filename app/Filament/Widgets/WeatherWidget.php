<?php

namespace App\Filament\Widgets;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Filament\Widgets\Widget;
use App\Models\Weather;
use App\Facades\WeatherInfo;
use App\Facades\IpInfo;
use App\Decorators\WeatherInfoDecorator;

class WeatherWidget extends Widget
{
    protected static string $view = 'filament.widgets.weather';
    

    public function getWeatherData()
    {
        return
            WeatherInfo::getWeatherData(
                IpInfo::getLatitude(),
                IpInfo::getLongitude()
            );
    }
}
