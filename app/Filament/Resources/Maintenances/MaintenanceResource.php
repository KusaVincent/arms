<?php

namespace App\Filament\Resources\Maintenances;

use App\Filament\Resources\Maintenances\Pages\CreateMaintenance;
use App\Filament\Resources\Maintenances\Pages\EditMaintenance;
use App\Filament\Resources\Maintenances\Pages\ListMaintenances;
use App\Filament\Resources\Maintenances\RelationManagers\PropertyRelationManager;
use App\Filament\Resources\Maintenances\RelationManagers\TenantRelationManager;
use App\Filament\ReusableResources\ResourceForm\MaintenanceForm;
use App\Filament\ReusableResources\ResourceTable\MaintenanceTable;
use App\Models\Maintenance;
use BackedEnum;
use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class MaintenanceResource extends Resource
{
    protected static ?string $model = Maintenance::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    /**
     * @throws Exception
     */
    public static function form(Schema $schema): Schema
    {
        return MaintenanceForm::form($schema);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return MaintenanceTable::columns($table)
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TenantRelationManager::class,
            PropertyRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMaintenances::route('/'),
            'create' => CreateMaintenance::route('/create'),
            'edit' => EditMaintenance::route('/{record}/edit'),
        ];
    }
}
