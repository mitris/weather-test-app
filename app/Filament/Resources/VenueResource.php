<?php

namespace App\Filament\Resources;

use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Builder;
use Humaidem\FilamentMapPicker\Fields\OSMMap;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Forms;
use App\Models\Venue;
use App\Filament\Resources\VenueResource\RelationManagers\EventsRelationManager;
use App\Filament\Resources\VenueResource\Pages;

class VenueResource extends Resource
{
    protected static ?string $model = Venue::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        TextInput::make('name')
                            ->required(),
                    ]),
                    Section::make([
                        OSMMap::make('location')
                            ->label('Location')
                            ->showMarker()
                            ->draggable()
                            ->extraControl([
                                'zoomDelta'           => 1,
                                'zoomSnap'            => 0.25,
                                'wheelPxPerZoomLevel' => 60
                            ])
                            // tiles url (refer to httpsw://www.spatialbias.com/2018/02/qgis-3.0-xyz-tile-layers/)
                            ->tilesUrl('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}')
                    ]),
                ])->columnSpanFull(),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('events_count')->counts('events'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->withCount('events'));
    }

    public static function getRelations(): array
    {
        return [
            EventsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVenues::route('/'),
            'create' => Pages\CreateVenue::route('/create'),
            'edit' => Pages\EditVenue::route('/{record}/edit'),
        ];
    }
}
