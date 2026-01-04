<?php

namespace App\Filament\Resources\LeaseAgreements\RelationManagers;

use App\Filament\Resources\Tenants\Schemas\TenantForm;
use App\Filament\Resources\Tenants\Tables\TenantTable;
use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class TenantRelationManager extends RelationManager
{
    protected static string $relationship = 'tenant';

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return TenantForm::configure($schema);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return TenantTable::configure($table)
            ->recordTitleAttribute('fullname')
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
