<?php

namespace App\Decorators;

use Carbon\Carbon;
use App\Facades\IpInfo;
use App\Enums\BeaufortScale;
use App\Contracts\BaseIpInfoProvider;
use App\Contracts\AbstractWeatherInfoDecorator;

class WeatherInfoDecorator extends AbstractWeatherInfoDecorator
{
    protected ?BaseIpInfoProvider $ipInfo;

    public function __construct(protected array $weatherData)
    {
        $this->beaufortScale = BeaufortScale::getNameByWindSpeed($this->current('windSpeed'));
    }

    public function __call($name, $arguments)
    {
        $diffSuffix = 'DiffWithPrev';
        if (str($name)->endsWith($diffSuffix)) {
            $param = str($name)->remove($diffSuffix);
            $prevHour = date('G') - 1;
            $prevHour = data_get($this->weatherData, "hours.{$prevHour}");

            return $prevHour ? round($this->current($param) - data_get($prevHour, $param), 2) : null;
        }
    }
}
