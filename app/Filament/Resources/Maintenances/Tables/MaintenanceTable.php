<?php

namespace App\Filament\Resources\Maintenances\Tables;

use Exception;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MaintenanceTable
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
                TextColumn::make('property.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('tenant.user.name')
                    ->label('Tenant')
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
