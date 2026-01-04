<?php

namespace App\Filament\Resources\Amenities\RelationManagers;

use App\Filament\Resources\Properties\Schemas\PropertyForm;
use App\Filament\Resources\Properties\Tables\PropertyTable;
use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PropertiesRelationManager extends RelationManager
{
    protected static string $relationship = 'properties';

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return PropertyForm::configure($schema);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return PropertyTable::configure($table)
            ->recordTitleAttribute('name')
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
