<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Filament\Resources\Locations\Schemas\LocationForm;
use App\Filament\Resources\Locations\Tables\LocationTable;
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
        return LocationForm::configure($schema);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return LocationTable::configure($table)
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
