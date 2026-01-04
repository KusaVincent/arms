<?php

namespace App\Filament\Resources\Abouts\Tables;

use Exception;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AboutTable
{
    /**
     * @throws Exception
     */
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('mnemonic')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('content')
                    ->searchable()
                    ->words(12),
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
