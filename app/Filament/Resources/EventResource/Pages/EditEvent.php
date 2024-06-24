<?php

namespace App\Filament\Resources\EventResource\Pages;

use Illuminate\Support\Str;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;
use App\Filament\Resources\EventResource;

class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data = collect($data);

        $period = Str::of($data->pull('period'))->explode('to')->filter()->map(fn ($item) => trim($item));

        $data->put('date_start', match ($period->count()) {
            1, 2 => $period->first(),
            default => null
        });

        $data->put('date_end', match ($period->count()) {
            2 => $period->last(),
            default => null
        });

        return $data->toArray();
    }
}
