<?php

namespace App\Filament\ReusableResources\ResourceTable;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LeaseAgreementTable
{
    /**
     * @throws \Exception
     */
    public static function columns(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tenant.fullname')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('property.name')
                    ->searchable(),
                TextColumn::make('lease_start_date')
                    ->dateTime()
                    ->searchable(),
                TextColumn::make('lease_end_date')
                    ->dateTime()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('rent_amount')
                    ->searchable(),
                TextColumn::make('deposit_amount')
                    ->searchable(),
                TextColumn::make('lease_term')
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
