<?php

namespace App\Filament\Resources\Payments\RelationManagers;

use App\Filament\ReusableResources\ResourceForm\LeaseAgreementForm;
use App\Filament\ReusableResources\ResourceTable\LeaseAgreementTable;
use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class LeaseAgreementsRelationManager extends RelationManager
{
    protected static string $relationship = 'leaseAgreement';

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return LeaseAgreementForm::form($schema);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return LeaseAgreementTable::columns($table)
            ->recordTitleAttribute('property.name')
            ->filters([
                //
            ])
            ->headerActions([
                //                Tables\Actions\CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
