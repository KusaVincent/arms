<?php

namespace App\Filament\ReusableResources\ResourceTable;

use Exception;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceAvailabilityTable
{
    /**
     * @throws Exception
     */
    public static function columns(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('service_name')
                    ->label('Service'),
                TextColumn::make('service_key')
                    ->label('Key'),
                TextColumn::make('is_active')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->label('Active'),
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
