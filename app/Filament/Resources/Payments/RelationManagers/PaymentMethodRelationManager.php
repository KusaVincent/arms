<?php

namespace App\Filament\Resources\Payments\RelationManagers;

use App\Filament\Resources\PaymentMethods\Schemas\PaymentMethodForm;
use App\Filament\Resources\PaymentMethods\Tables\PaymentMethodTable;
use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PaymentMethodRelationManager extends RelationManager
{
    protected static string $relationship = 'paymentMethod';

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return PaymentMethodForm::configure($schema);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return PaymentMethodTable::configure($table)
            ->recordTitleAttribute('name')
            ->filters([
                //
            ])
            ->headerActions([
                //                Tables\Actions\CreateAction::make(),
            ])
            ->recordActions([
                //                Tables\Actions\EditAction::make(),
                //                Tables\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
