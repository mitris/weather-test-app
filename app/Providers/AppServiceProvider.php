<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\IpInfoService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(IpInfoService::class, function ($app) {
            $providerClass = config('services.ip_info.provider');

            return new IpInfoService(new $providerClass($app->request));
        });


        $this->app->singleton('weather', \App\Services\WeatherService::class);
        $this->app->singleton('color', \App\Services\ColorService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
