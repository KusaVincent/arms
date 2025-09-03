<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Filament\ReusableResources\ResourceForm\LocationForm;
use App\Filament\ReusableResources\ResourceTable\LocationTable;
use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class LocationRelationManager extends RelationManager
{
    protected static string $relationship = 'location';

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return LocationForm::form($schema);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return LocationTable::columns($table)
            ->recordTitleAttribute('town_city')
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
