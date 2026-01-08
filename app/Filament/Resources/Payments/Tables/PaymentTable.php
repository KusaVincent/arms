<?php

namespace App\Filament\Resources\Payments\Tables;

use App\Models\LeaseAgreement;
use App\Models\PackageSubscription;
use Exception;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentTable
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
                TextColumn::make('payable_user')
                    ->label('Paid By / Target')
                    ->getStateUsing(function ($record) {
                        $payable = $record->payable;

                        return match (true) {
                            $payable instanceof LeaseAgreement => $payable->tenant?->user?->name,
                            $payable instanceof PackageSubscription => $payable->operator?->user?->name,
                            default => null,
                        } ?? 'N/A';
                    })
                    ->description(fn ($record): string => match ($record->payable_type) {
                        'lease', LeaseAgreement::class => 'Lease Agreement',
                        'subscription', PackageSubscription::class => 'Subscription Package',
                        default => 'Other',
                    }),
                TextColumn::make('payable_item')
                    ->label('Paid For')
                    ->getStateUsing(function ($record) {
                        $payable = $record->payable;

                        return match (true) {
                            $payable instanceof LeaseAgreement => $payable->property?->name,
                            $payable instanceof PackageSubscription => $payable->packageDescription?->name,
                            default => null,
                        } ?? '—';
                    }),
                TextColumn::make('paymentMethod.name')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->label('Payment Method')
                    ->color(fn ($record): string => $record->paymentMethod?->color ?? 'gray'),
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
