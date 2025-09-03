<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Filament\ReusableResources\ResourceForm\AmenityForm;
use App\Filament\ReusableResources\ResourceTable\AmenityTable;
use Exception;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DetachAction;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class AmenitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'amenities';

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return AmenityForm::form($schema);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return AmenityTable::columns($table)
            ->recordTitleAttribute('amenity_name')
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make(),
                CreateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
