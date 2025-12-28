<?php

namespace App\Filament\ReusableResources\ResourceTable;

use App\Actions\AssignColor;
use Exception;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TenantTable
{
    /**
     * @throws Exception
     */
    public static function columns(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('mnemonic')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.email')
                    ->label('Email'),
                TextColumn::make('user.phone_number')
                    ->label('Phone Number'),
                TextColumn::make('user.roles.name')
                    ->badge()
                    ->label('Role')
                    ->color(fn (string $state): string => AssignColor::getColor($state)),
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
