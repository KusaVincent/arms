<?php

namespace App\Filament\Resources\Locations\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Validation\Rules\Unique;

class LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Geographic Location')
                    ->description('Manage physical addresses and mapping coordinates for property listings.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Group::make([
                                    Section::make('Physical Address')
                                        ->icon(Heroicon::MapPin)
                                        ->compact()
                                        ->schema([
                                            TextInput::make('town_city')
                                                ->label('Town / City')
                                                ->placeholder('e.g. Mumbai')
                                                ->required()
                                                ->unique(
                                                    table: 'locations',
                                                    column: 'town_city',
                                                    ignoreRecord: true,
                                                    modifyRuleUsing: fn (Unique $rule, callable $get) => $rule
                                                        ->where('address', $get('address'))
                                                        ->where('area', $get('area'))
                                                )
                                                ->validationMessages([
                                                    'unique' => 'This exact address already exists in our records.',
                                                ]),

                                            TextInput::make('area')
                                                ->label('Area / Neighborhood')
                                                ->placeholder('e.g. Bandra West')
                                                ->required(),

                                            TextInput::make('address')
                                                ->label('Street Address')
                                                ->placeholder('e.g. 123 Sunshine Apartments, Hill Road')
                                                ->required()
                                                ->columnSpanFull(),
                                        ])->columns(2),
                                ])->columnSpan(2),

                                Group::make([
                                    Section::make('Digital Map')
                                        ->icon(Heroicon::Map)
                                        ->compact()
                                        ->schema([
                                            TextInput::make('map')
                                                ->label('Map Link / URL')
                                                ->placeholder('Google Maps Link')
                                                ->url()
                                                ->required(),
                                        ]),

                                    Section::make('Audit Trail')
                                        ->icon(Heroicon::Clock)
                                        ->compact()
                                        ->visible(fn ($livewire) => $livewire instanceof EditRecord)
                                        ->schema([
                                            DateTimePicker::make('created_at')
                                                ->label('Record Created')
                                                ->disabled()
                                                ->dehydrated(false),

                                            DateTimePicker::make('updated_at')
                                                ->label('Last Modified')
                                                ->disabled()
                                                ->dehydrated(false),
                                        ]),
                                ])->columnSpan(1),
                            ]),
                    ]),
            ]);
    }
}
