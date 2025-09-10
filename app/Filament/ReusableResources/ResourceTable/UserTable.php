<?php

namespace App\Filament\ReusableResources\ResourceTable;

use App\Actions\AssignColor;
use Exception;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserTable
{
    /**
     * @throws Exception
     */
    public static function columns(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('roles.name')
                    ->badge()
                    ->color(fn (string $state): string => AssignColor::getColor($state)),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable()
                    ->label('Added On'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable()
                    ->label('Date Updated'),
            ]);
    }
}
