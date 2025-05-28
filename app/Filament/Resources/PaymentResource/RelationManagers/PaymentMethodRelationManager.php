<?php

namespace App\Filament\Resources\PaymentResource\RelationManagers;

use App\Filament\ReusableResources\ReusablePaymentMethodResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentMethodRelationManager extends RelationManager
{
    protected static string $relationship = 'paymentMethod';

    public function form(Form $form): Form
    {
        return ReusablePaymentMethodResource::form($form);
    }

    public function table(Table $table): Table
    {
        return ReusablePaymentMethodResource::columns($table)
            ->recordTitleAttribute('name')
            ->filters([
                //
            ])
            ->headerActions([
                //                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                //                Tables\Actions\EditAction::make(),
                //                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
