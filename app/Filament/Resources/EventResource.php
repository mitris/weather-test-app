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
                            DateRangePicker::make('date_start')
                                ->columnSpan(4)
                                ->startDate(now())
                                ->defaultToday()
                                ->alwaysShowCalendar()
                                ->timePicker(false)
                                ->singleCalendar()
                                ->autoApply()
                                ->displayFormat('YYYY-MM-DD')
                                ->format('YYYY-MM-DD')
                                ->disableRanges()
                                ->separator(' to ')
                                // ->default(fn (Event $event) => $event->get('date_start') . ' to ' . $event->get('date_end'))
                                ->endDate(now()->addYear())
                                ->disableClear(),
                            DateRangePicker::make('date_end',)
                                ->columnSpan(4)
                                ->startDate(now())
                                ->defaultToday()
                                ->alwaysShowCalendar()
                                ->timePicker(false)
                                ->singleCalendar()
                                ->autoApply()
                                ->displayFormat('YYYY-MM-DD')
                                ->format('YYYY-MM-DD')
                                ->disableRanges()
                                ->separator(' to ')
                                // ->default(fn (Event $event) => $event->get('date_start') . ' to ' . $event->get('date_end'))
                                ->endDate(now()->addYear())
                                ->disableClear()
                        ])
                            ->columnSpan(8)
                            ->columns(12),
                        Group::make([
                            SpatieMediaLibraryFileUpload::make('poster')
                                ->directory('posters')
                                ->conversion('thumb')
                                ->responsiveImages(),
                            SpatieMediaLibraryFileUpload::make('media')
                                ->directory('medias')
                                ->multiple()
                                ->reorderable(),
                        ])->columnSpan(4),
                    ])->columns(12)
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('poster')
                    ->circular(),
                TextColumn::make('preview')->getStateUsing(function (Event $event) {
                    return $event->name . '<div class="text-slate-500 bg-red-200"><small>Date: <b>' . implode(' - ', [$event->date_start->format('Y.m.d, H:i'), $event->date_end->format('Y.m.d, H:i')]) . ' </b></small></div>';
                })->html(),
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
