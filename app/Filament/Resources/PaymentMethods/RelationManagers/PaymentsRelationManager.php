<?php

namespace App\Filament\Resources\PaymentMethods\RelationManagers;

use App\Filament\ReusableResources\ResourceForm\PaymentForm;
use App\Filament\ReusableResources\ResourceTable\PaymentTable;
use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return PaymentForm::form($schema);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return PaymentTable::columns($table)
            ->recordTitleAttribute('')
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
