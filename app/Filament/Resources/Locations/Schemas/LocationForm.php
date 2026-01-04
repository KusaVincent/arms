<?php

namespace App\Filament\Resources\Locations\Schemas;

use Exception;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Unique;

class LocationForm
{
    /**
     * @throws Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('town_city')
                            ->required()
                            ->unique(
                                table: 'locations',
                                column: 'town_city',
                                ignoreRecord: true,
                                modifyRuleUsing: fn (Unique $rule, callable $get) => $rule->where('address', $get('address'))
                                    ->where('area', $get('area'))
                            )
                            ->validationMessages([
                                'unique' => 'This address already exists for the selected town/city and area.',
                            ]),
                        TextInput::make('area')
                            ->required(),
                        TextInput::make('address')
                            ->required(),
                        TextInput::make('map')
                            ->required()
                            ->label('Map Link'),
                    ])->columns(),
            ]);
    }
}
