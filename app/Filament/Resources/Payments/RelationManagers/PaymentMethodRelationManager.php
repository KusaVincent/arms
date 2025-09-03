<?php

namespace App\Filament\Resources\Payments\RelationManagers;

use App\Filament\ReusableResources\ResourceForm\PaymentMethodForm;
use App\Filament\ReusableResources\ResourceTable\PaymentMethodTable;
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
        return PaymentMethodForm::form($schema);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return PaymentMethodTable::columns($table)
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
