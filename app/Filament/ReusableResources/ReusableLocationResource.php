<?php

namespace App\Filament\ReusableResources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class ReusableLocationResource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('town_city')
                            ->required(),
                        Forms\Components\TextInput::make('area')
                            ->required(),
                        Forms\Components\TextInput::make('address')
                            ->required(),
                        Forms\Components\TextInput::make('map')
                            ->required()
                            ->label('Map Link'),
                    ])->columns(),
            ]);
    }

    public static function columns(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('town_city')
                    ->searchable()
                    ->label('Town City'),
                Tables\Columns\TextColumn::make('area')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('map')
                    ->limit(30),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Added On')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Date Updated')
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
