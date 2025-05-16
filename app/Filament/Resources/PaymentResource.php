<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                    ->numeric()
                    ->required(),
                Forms\Components\DatePicker::make('payment_date')
                    ->date()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('leaseAgreement.tenant.last_name')
                    ->sortable()
                    ->searchable()
                    ->label('Tenant Name'),
                Tables\Columns\TextColumn::make('leaseAgreement.property.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->sortable()
                    ->searchable()
                    ->label('Payment Method'),
                Tables\Columns\TextColumn::make('payment_amount')
                    ->sortable()
                    ->searchable()
                    ->label('Amount'),
                Tables\Columns\TextColumn::make('payment_date')
                    ->sortable()
                    ->searchable()
                    ->label('Payment Date'),
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
