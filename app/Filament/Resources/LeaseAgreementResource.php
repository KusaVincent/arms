<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaseAgreementResource\Pages;
use App\Filament\Resources\LeaseAgreementResource\RelationManagers\PropertyRelationManager;
use App\Filament\Resources\LeaseAgreementResource\RelationManagers\TenantRelationManager;
use App\Models\LeaseAgreement;
use App\Utils\SanitizationHelper;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LeaseAgreementResource extends Resource
{
    protected static ?string $model = LeaseAgreement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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

    public static function table(Table $table): Table
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
                    ->searchable(),
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TenantRelationManager::class,
            PropertyRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeaseAgreements::route('/'),
            'create' => Pages\CreateLeaseAgreement::route('/create'),
            'edit' => Pages\EditLeaseAgreement::route('/{record}/edit'),
        ];
    }
}
