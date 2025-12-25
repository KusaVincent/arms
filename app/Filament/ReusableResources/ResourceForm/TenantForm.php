<?php

namespace App\Filament\ReusableResources\ResourceForm;

use Exception;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TenantForm
{
    /**
     * @throws Exception
     */
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Details')
                    ->relationship('user')
                    ->schema([
                        Section::make()
                            ->schema([
                                TextInput::make('first_name')
                                    ->required(),
                                TextInput::make('middle_name'),
                                TextInput::make('last_name')
                                    ->required(),
                            ])->columns(3),

                        Section::make()
                            ->schema([
                                Select::make('roles')
                                    ->relationship('roles', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable(),
                                TextInput::make('email')
                                    ->email()
                                    ->required(),
                                TextInput::make('phone_number')
                                    ->tel()
                                    ->required(),
                            ])->columns(3),
                    ]),
            ]);
    }
}
