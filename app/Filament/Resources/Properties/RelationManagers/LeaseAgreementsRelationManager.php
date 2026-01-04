<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Filament\Resources\LeaseAgreements\Schemas\LeaseAgreementForm;
use App\Filament\Resources\LeaseAgreements\Tables\LeaseAgreementTable;
use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class LeaseAgreementsRelationManager extends RelationManager
{
    protected static string $relationship = 'leaseAgreements';

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return LeaseAgreementForm::configure($schema);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return LeaseAgreementTable::configure($table)
            ->recordTitleAttribute('tenant.first_name')
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                //                Tables\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
