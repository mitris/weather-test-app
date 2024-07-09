<?php

namespace App\Filament\Widgets;

use Livewire\Attributes\Computed;
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

class WeatherWidgetAlt extends Widget
{
    protected static string $view = 'filament.widgets.weather-alt';

    protected int | string | array $columnSpan = 2;

    // public function getColumns(): int | string | array
    // {
    //     return 2;
    // }

    #[Computed]
    public function getWeatherData()
    {
        return
            WeatherInfo::getWeatherData(
                IpInfo::getLatitude(),
                IpInfo::getLongitude()
            );
    }


    public function getForecast()
    {
        return Weather::where([
            'latitude' => IpInfo::getLatitude(),
            'longitude' => IpInfo::getLongitude(),
            ['date', '>=', now()->startOfDay()]
        ])->limit(7)->get();
    }
}
