<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Filament\ReusableResources\ResourceForm\MaintenanceForm;
use App\Filament\ReusableResources\ResourceTable\MaintenanceTable;
use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class MaintenanceRelationManager extends RelationManager
{
    protected static string $relationship = 'maintenance';

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return MaintenanceForm::form($schema);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return MaintenanceTable::columns($table)
            ->recordTitleAttribute('request_date')
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
