<?php

namespace App\Filament\ReusableResources;

use App\Actions\AssignColor;
use App\Utils\SanitizationHelper;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables;
use Filament\Tables\Table;

class ReusablePaymentResource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('lease_agreement_id')
                            ->required()
                            ->searchable()
                            ->label('Lease Agreement')
                            ->relationship('leaseAgreement.tenant', 'last_name'),
                        Forms\Components\TextInput::make('payment_method')
                            ->required()
                            ->label('Payment Method'),
                        Forms\Components\TextInput::make('payment_amount')
                            ->required()
                            ->formatStateUsing(fn ($state, $livewire) => $livewire instanceof EditRecord
                                ? SanitizationHelper::stripFormatting($state)
                                : $state
                            )
                            ->label('Payment Amount')
                            ->dehydrateStateUsing(fn ($state) => $state)
                            ->rules(fn ($livewire): array => $livewire instanceof ViewRecord ? [] : ['numeric']),
                        Forms\Components\DatePicker::make('payment_date')
                            ->date()
                            ->required()
                            ->label('Payment Date'),
                    ])->columns(),
            ]);
    }

    public static function columns(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('leaseAgreement.tenant.fullname')
                    ->sortable()
                    ->searchable()
                    ->label('Tenant Name'),
                Tables\Columns\TextColumn::make('leaseAgreement.property.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->label('Payment Method')
                    ->color(fn (string $state): string => AssignColor::getColor($state)),
                Tables\Columns\TextColumn::make('payment_amount')
                    ->sortable()
                    ->searchable()
                    ->label('Amount'),
                Tables\Columns\TextColumn::make('payment_date')
                    ->sortable()
                    ->searchable()
                    ->label('Payment Date'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Added On')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Date Updated')
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
