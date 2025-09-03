<?php

namespace App\Filament\ReusableResources\ResourceForm;

use Exception;
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
                Section::make()
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
                                TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                TextInput::make('phone')
                                    ->tel()
                                    ->required(),
                                TextInput::make('password')
                                    ->visible(fn ($livewire): bool => $livewire instanceof CreateRecord)
                                    ->password()
                                    ->required()
                                    ->confirmed(),
                                TextInput::make('password_confirmation')
                                    ->visible(fn ($livewire): bool => $livewire instanceof CreateRecord)
                                    ->password()
                                    ->required()
                                    ->dehydrated(false),
                            ])->columns(),
                    ]),
            ]);
    }
}
