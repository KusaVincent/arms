<?php

namespace App\Filament\Resources\PaymentMethods\Tables;

use Exception;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentMethodTable
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
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Added On'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Date Updated'),
            ]);
    }
}
