<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Filament\Resources\Maintenances\Schemas\MaintenanceForm;
use App\Filament\Resources\Maintenances\Tables\MaintenanceTable;
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
        return MaintenanceForm::configure($schema);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return MaintenanceTable::configure($table)
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
