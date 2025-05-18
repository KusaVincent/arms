<?php

namespace App\Filament\Resources;

use App\Actions\ColorAssignment;
use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use App\Utils\SanitizationHelper;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('lease_agreement_id')
                    ->required()
                    ->searchable()
                    ->relationship('leaseAgreement.tenant', 'last_name'),
                Forms\Components\TextInput::make('payment_method')
                    ->required(),
                Forms\Components\TextInput::make('payment_amount')
                    ->required()
                    ->formatStateUsing(fn ($state, $livewire) => $livewire instanceof EditRecord
                            ? SanitizationHelper::stripFormatting($state)
                            : $state
                    )
                    ->dehydrateStateUsing(fn ($state) => $state)
                    ->rules(fn ($livewire): array => $livewire instanceof ViewRecord ? [] : ['numeric']),
                Forms\Components\DatePicker::make('payment_date')
                    ->date()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
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
                    ->color(fn (string $state): string => ColorAssignment::getColor($state)),
                Tables\Columns\TextColumn::make('payment_amount')
                    ->sortable()
                    ->searchable()
                    ->label('Amount'),
                Tables\Columns\TextColumn::make('payment_date')
                    ->sortable()
                    ->searchable()
                    ->label('Payment Date'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            //            'create' => Pages\CreatePayment::route('/create'),
            //            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
