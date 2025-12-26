<?php

namespace App\Filament\ReusableResources\ResourceForm;

use Exception;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    /**
     * @throws Exception
     */
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('first_name')
                            ->required(),
                        TextInput::make('middle_name'),
                        TextInput::make('last_name')
                            ->required(),
                        TextInput::make('phone_number')
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                        Select::make('roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable(),
                        TextInput::make('password')
                            ->password()
                            ->required()
                            ->confirmed()
                            ->visible(fn ($livewire): bool => $livewire instanceof CreateRecord),
                        TextInput::make('password_confirmation')
                            ->password()
                            ->required()
                            ->dehydrated(false)
                            ->visible(fn ($livewire): bool => $livewire instanceof CreateRecord),
                    ])->columns(),
            ]);
    }
}
