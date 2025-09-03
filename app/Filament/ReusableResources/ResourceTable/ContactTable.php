<?php

namespace App\Filament\ReusableResources\ResourceTable;

use Exception;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactTable
{
    /**
     * @throws Exception
     */
    public static function columns(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('icon')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('link')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('link_text')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('section')
                    ->badge()
                    ->sortable()
                    ->searchable(),
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
