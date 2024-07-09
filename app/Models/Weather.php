<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Weather extends Model
{
    use HasFactory;

    public $guarded = [];

    public $timestamps = false;

    protected function casts()
    {
        return [
            'hours' => 'array',
            'date' => 'date:Y-m-d',
        ];
    }

    protected function getCurrentAirTemperatureAvgAttribute()
    {
        return round(collect(data_get($this->hours, '*.airTemperature'))->avg() ?? 0, 2);
    }
}
