<?php

namespace App\Filament\Resources\LeaseAgreements\RelationManagers;

use App\Filament\ReusableResources\ResourceForm\PropertyForm;
use App\Filament\ReusableResources\ResourceTable\PropertyTable;
use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PropertyRelationManager extends RelationManager
{
    protected static string $relationship = 'property';

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return PropertyForm::form($schema);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return PropertyTable::columns($table)
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
