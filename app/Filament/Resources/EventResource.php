<?php

namespace App\Filament\Resources;

use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\DatePicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use App\Models\Event;
use App\Filament\Resources\EventResource\Pages\ListEvents;
use App\Filament\Resources\EventResource\Pages\EditEvent;
use App\Filament\Resources\EventResource\Pages\CreateEvent;

class EventResource extends Resource
{

    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Grid::make(12)->schema([
                        Group::make([
                            Select::make('venue_id')
                                ->relationship('venue', 'name')
                                ->searchable()
                                ->native(false)
                                ->preload()
                                ->createOptionForm([
                                    TextInput::make('name')
                                        ->required(),

                                ])
                                ->required()
                                ->columnSpanFull(),
                            TextInput::make('name')
                                ->required()
                                ->columnSpanFull(),
                            RichEditor::make('description')
                                ->columnSpanFull(),
                            DatePicker::make('date_start'),
                        ])
                            ->columnSpan(8)
                            ->columns(12),
                        Group::make([
                            CuratorPicker::make('poster')

                            // SpatieMediaLibraryFileUpload::make('media')
                            //     ->directory('medias')
                            //     ->multiple()
                            //     ->reorderable(),
                        ])->columnSpan(4),
                    ])->columns(12)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('poster')
                    ->size(40),
                TextColumn::make('name'),
                TextColumn::make('date_start'),
                TextColumn::make('venue.name')
                    ->numeric()
                    ->sortable(),
            ])
            // ->deferLoading()
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
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEvents::route('/'),
            'create' => CreateEvent::route('/create'),
            'edit' => EditEvent::route('/{record}/edit'),
        ];
    }
}
