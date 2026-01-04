<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Filament\Resources\PropertyTypes\Schemas\PropertyTypeForm;
use App\Filament\Resources\PropertyTypes\Tables\PropertyTypeTable;
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
        return PropertyTypeForm::configure($schema);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return PropertyTypeTable::configure($table)
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
