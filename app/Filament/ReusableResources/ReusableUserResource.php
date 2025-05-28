<?php

namespace App\Filament\ReusableResources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Tables;
use Filament\Tables\Table;

class ReusableUserResource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->confirmed()
                            ->visible(fn ($livewire): bool => $livewire instanceof CreateRecord),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->password()
                            ->required()
                            ->dehydrated(false)
                            ->visible(fn ($livewire): bool => $livewire instanceof CreateRecord),
                    ])->columns(),
            ]);
    }

    public static function columns(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable()
                    ->label('Added On'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable()
                    ->label('Date Updated'),
            ]);
    }
}
