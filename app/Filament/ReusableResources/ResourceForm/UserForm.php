<?php

namespace App\Filament\ReusableResources\ResourceForm;

use Exception;
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
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
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
