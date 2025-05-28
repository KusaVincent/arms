<?php

namespace App\Filament\ReusableResources;

use App\Utils\SanitizationHelper;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables;
use Filament\Tables\Table;

class ReusableLeaseAgreementResource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Select::make('tenant_id')
                                    ->required()
                                    ->searchable()
                                    ->relationship('tenant', 'first_name'),
                                Forms\Components\Select::make('property_id')
                                    ->required()
                                    ->searchable()
                                    ->relationship('property', 'name'),
                            ])->columns(),
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\DatePicker::make('lease_start_date')
                                    ->date()
                                    ->required(),
                                Forms\Components\DatePicker::make('lease_end_date')
                                    ->date(),
                                Forms\Components\TextInput::make('lease_term')
                                    ->required(),
                            ])->columns(3),
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('rent_amount')
                                    ->required()
                                    ->formatStateUsing(fn ($state, $livewire) => $livewire instanceof EditRecord
                                        ? SanitizationHelper::stripFormatting($state)
                                        : $state
                                    )
                                    ->dehydrateStateUsing(fn ($state) => $state)
                                    ->rules(fn ($livewire): array => $livewire instanceof ViewRecord ? [] : ['numeric']),
                                Forms\Components\TextInput::make('deposit_amount')
                                    ->required()
                                    ->formatStateUsing(fn ($state, $livewire) => $livewire instanceof EditRecord
                                        ? SanitizationHelper::stripFormatting($state)
                                        : $state
                                    )
                                    ->dehydrateStateUsing(fn ($state) => $state)
                                    ->rules(fn ($livewire): array => $livewire instanceof ViewRecord ? [] : ['numeric']),
                            ])->columns(),
                    ]),
            ]);
    }

    public static function columns(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tenant.fullname')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('property.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lease_start_date')
                    ->dateTime()
                    ->searchable(),
                Tables\Columns\TextColumn::make('lease_end_date')
                    ->dateTime()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('rent_amount')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deposit_amount')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lease_term')
                    ->searchable(),
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
