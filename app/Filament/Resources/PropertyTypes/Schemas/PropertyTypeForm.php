<?php

namespace App\Filament\Resources\PropertyTypes\Schemas;

use Exception;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PropertyTypeForm
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
                        TextInput::make('type_name')
                            ->required(),
                    ]),
            ]);
    }
}
