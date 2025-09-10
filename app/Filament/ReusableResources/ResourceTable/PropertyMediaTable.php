<?php

namespace App\Filament\ReusableResources\ResourceTable;

use Exception;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PropertyMediaTable
{
    /**
     * @throws Exception
     */
    public static function columns(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('property.name')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('image_one')
                    ->disk('public'),
                ImageColumn::make('image_two')
                    ->disk('public'),
                ImageColumn::make('image_three')
                    ->disk('public'),
                ImageColumn::make('image_four')
                    ->disk('public'),
                ImageColumn::make('image_five')
                    ->disk('public'),
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
