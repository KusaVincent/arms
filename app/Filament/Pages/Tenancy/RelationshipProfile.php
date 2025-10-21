<?php

namespace App\Filament\Pages\Tenancy;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RelationshipProfile
{
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->trim()
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->afterStateUpdated(fn (string $state, callable $set) => $set('name', ucwords(strtolower($state))))
                    ->mutateDehydratedStateUsing(fn (string $state): string => ucwords(strtolower($state))),
            ]);
    }
}
