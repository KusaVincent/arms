<?php

namespace App\Filament\ReusableResources\ResourceTable;

use App\Actions\AssignColor;
use Exception;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentTable
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
                TextColumn::make('leaseAgreement.tenant.fullname')
                    ->sortable()
                    ->searchable()
                    ->label('Tenant Name'),
                TextColumn::make('leaseAgreement.property.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('paymentMethod.name')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->label('Payment Method')
                    ->color(fn (string $state): string => AssignColor::getColor($state)),
                TextColumn::make('payment_amount')
                    ->sortable()
                    ->searchable()
                    ->label('Amount'),
                TextColumn::make('payment_date')
                    ->sortable()
                    ->searchable()
                    ->label('Payment Date'),
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
