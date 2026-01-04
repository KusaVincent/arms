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
                    ->state(fn ($record) => $record->payable)
                    ->formatStateUsing(function ($state) {
                        if (! $state) {
                            return 'N/A';
                        }

                        return match (true) {
                            $state instanceof LeaseAgreement => $state->tenant?->user?->name ?? 'Unknown Tenant',
                            $state instanceof PackageSubscription => $state->user?->name ?? 'Unknown User',
                            default => 'Unknown',
                        };
                    })
                    ->description(fn ($record): string => match ($record->payable_type) {
                        'lease', LeaseAgreement::class => 'Lease Agreement',
                        'subscription', PackageSubscription::class => 'Subscription Package',
                        default => 'Other',
                    })->searchable(query: function ($query, string $search): void {
                        $query->whereHasMorph(
                            'payable',
                            [LeaseAgreement::class, PackageSubscription::class],
                            function ($query, $type) use ($search) {
                                if ($type === LeaseAgreement::class) {
                                    $query->whereHas('tenant.user', function ($q) use ($search) {
                                        $q->where('name', 'ilike', "%{$search}%");
                                    });
                                }
                                if ($type === PackageSubscription::class) {
                                    $query->whereHas('user', function ($q) use ($search) {
                                        $q->where('name', 'ilike', "%{$search}%");
                                    });
                                }
                            }
                        );
                    }),
                TextColumn::make('payable_item')
                    ->label('Paid For')
                    ->state(fn ($record) => $record->payable)
                    ->formatStateUsing(function ($state) {
                        if (! $state) {
                            return '—';
                        }

                        return match (true) {
                            $state instanceof LeaseAgreement => $state->property?->name ?? 'No Property',
                            $state instanceof PackageSubscription => $state->packageDescription?->name ?? 'No Package',
                            default => 'Unknown Type',
                        };
                    })->searchable(query: function ($query, string $search): void {
                        $query->whereHasMorph(
                            'payable',
                            [LeaseAgreement::class, PackageSubscription::class],
                            function ($query, $type) use ($search) {
                                if ($type === LeaseAgreement::class) {
                                    $query->whereHas('property', function ($q) use ($search) {
                                        $q->where('name', 'ilike', "%{$search}%");
                                    });
                                }
                                if ($type === PackageSubscription::class) {
                                    $query->whereHas('packageDescription', function ($q) use ($search) {
                                        $q->where('name', 'ilike', "%{$search}%");
                                    });
                                }
                            }
                        );
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
