<?php

namespace App\Filament\ReusableResources;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReusableTenantResource
{
    public static function columns(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fullname')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email'),
                TextColumn::make('phone'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Added On')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Date Updated')
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
