<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Filament\Widgets\ChartWidget;
use App\Models\Event;

class WeatherChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $data = cache()->remember('events', 3600, fn() => Event::where('date_start', '>=', now()->startOfMonth())->groupBy(DB::raw('DATE(date_start)'))->select(DB::raw('COUNT(id) as counts'), DB::raw('DATE(date_start) as date'))->orderBy('date_start')->pluck('counts', 'date')->toArray());

        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => $data,
                ],
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
