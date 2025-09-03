<?php

namespace App\Filament\ReusableResources\ResourceForm;

use App\Utils\SanitizationHelper;
use Exception;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaymentForm
{
    /**
     * @throws Exception
     */
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Select::make('lease_agreement_id')
                            ->required()
                            ->searchable()
                            ->label('Lease Agreement')
                            ->relationship('leaseAgreement.tenant', 'last_name'),
                        Select::make('payment_method')
                            ->required()
                            ->label('Payment Method')
                            ->relationship('paymentMethod', 'name'),
                        TextInput::make('payment_amount')
                            ->required()
                            ->formatStateUsing(fn ($state, $livewire) => $livewire instanceof EditRecord
                                ? SanitizationHelper::stripFormatting($state)
                                : $state
                            )
                            ->label('Payment Amount')
                            ->dehydrateStateUsing(fn ($state) => $state)
                            ->rules(fn ($livewire): array => $livewire instanceof ViewRecord ? [] : ['numeric']),
                        DatePicker::make('payment_date')
                            ->date()
                            ->required()
                            ->label('Payment Date'),
                    ])->columns(),
            ]);
    }
}
