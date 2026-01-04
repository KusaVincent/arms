<?php

namespace App\Filament\Resources\Maintenances;

use AlizHarb\ActivityLog\RelationManagers\ActivitiesRelationManager;
use App\Filament\Resources\Maintenances\Pages\CreateMaintenance;
use App\Filament\Resources\Maintenances\Pages\EditMaintenance;
use App\Filament\Resources\Maintenances\Pages\ListMaintenances;
use App\Filament\Resources\Maintenances\RelationManagers\PropertyRelationManager;
use App\Filament\Resources\Maintenances\RelationManagers\TenantRelationManager;
use App\Filament\Resources\Maintenances\Schemas\MaintenanceForm;
use App\Filament\Resources\Maintenances\Tables\MaintenanceTable;
use App\Models\Maintenance;
use App\Traits\HasSharedResourceProperties;
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
    use HasSharedResourceProperties;

    protected static ?int $navigationSort = 7;

    protected static ?string $model = Maintenance::class;

    protected static ?string $recordTitleAttribute = 'property_name';

    protected static string|null|\UnitEnum $navigationGroup = 'Property Management';

    /**
     * @throws Exception
     */
    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return MaintenanceForm::configure($schema);
    }

    /**
     * @throws Exception
     */
    #[\Override]
    public static function table(Table $table): Table
    {
        return MaintenanceTable::configure($table)
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

    #[\Override]
    public static function getRelations(): array
    {
        return [
            TenantRelationManager::class,
            PropertyRelationManager::class,
            ActivitiesRelationManager::class,
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
