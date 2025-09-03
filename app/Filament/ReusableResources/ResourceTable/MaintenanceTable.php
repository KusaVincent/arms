<?php

namespace App\Filament\ReusableResources\ResourceTable;

use Exception;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MaintenanceTable
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
                TextColumn::make('tenant.fullname')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description')
                    ->searchable()
                    ->limit(10),
                TextColumn::make('request_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('completion_date')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Added On')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Date Updated')
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
