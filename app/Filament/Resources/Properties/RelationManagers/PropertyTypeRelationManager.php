<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Filament\ReusableResources\ResourceForm\PropertyTypeForm;
use App\Filament\ReusableResources\ResourceTable\PropertyTypeTable;
use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PropertyTypeRelationManager extends RelationManager
{
    protected static string $relationship = 'PropertyType';

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return PropertyTypeForm::form($schema);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return PropertyTypeTable::columns($table)
            ->recordTitleAttribute('type_name')
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
