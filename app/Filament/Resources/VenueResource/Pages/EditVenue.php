<?php

namespace App\Filament\Resources\VenueResource\Pages;

use JoseEspinal\RecordNavigation\Traits\HasRecordNavigation;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;
use App\Filament\Resources\VenueResource;

class EditVenue extends EditRecord
{
    use HasRecordNavigation;

    protected static string $resource = VenueResource::class;

    protected function getHeaderActions(): array
    {
        return array_merge([
            Actions\DeleteAction::make(),

        ], $this->getNavigationActions());
    }
}
