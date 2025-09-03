<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Filament\ReusableResources\ResourceForm\PropertyMediaForm;
use App\Filament\ReusableResources\ResourceTable\PropertyMediaTable;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PropertyMediaRelationManager extends RelationManager
{
    protected static string $relationship = 'PropertyMedia';

    /**
     * @throws \Exception
     */
    public function form(Schema $schema): Schema
    {
        return PropertyMediaForm::form($schema);
    }

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        return PropertyMediaTable::columns($table)
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
