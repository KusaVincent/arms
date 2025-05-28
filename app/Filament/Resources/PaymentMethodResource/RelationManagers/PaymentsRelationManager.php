<?php

namespace App\Filament\Resources\PaymentMethodResource\RelationManagers;

use App\Filament\ReusableResources\ReusablePaymentResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    public function form(Form $form): Form
    {
        return ReusablePaymentResource::form($form);
    }

    public function table(Table $table): Table
    {
        return ReusablePaymentResource::columns($table)
            ->recordTitleAttribute('')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
