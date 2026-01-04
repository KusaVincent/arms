<?php

namespace App\Filament\Resources\Users\Tables;

use App\Actions\AssignColor;
use Exception;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserTable
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
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('roles.name')
                    ->badge()
                    ->color(fn (string $state): string => AssignColor::getColor($state))
                    ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state))),
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
