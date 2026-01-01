<?php

namespace App\Filament\Resources\Tenants;

use AlizHarb\ActivityLog\RelationManagers\ActivitiesRelationManager;
use App\Filament\Resources\Tenants\Pages\CreateTenant;
use App\Filament\Resources\Tenants\Pages\EditTenant;
use App\Filament\Resources\Tenants\Pages\ListTenants;
use App\Filament\Resources\Tenants\RelationManagers\LeaseAgreementRelationManager;
use App\Filament\Resources\Tenants\RelationManagers\MaintenanceRelationManager;
use App\Filament\ReusableResources\ResourceForm\TenantForm;
use App\Filament\ReusableResources\ResourceTable\TenantTable;
use App\Models\Tenant;
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

class TenantResource extends Resource
{
    use HasSharedResourceProperties;

    protected static ?int $navigationSort = 2;

    protected static ?string $model = Tenant::class;

    protected static ?string $recordTitleAttribute = 'user_name';

    protected static string|null|\UnitEnum $navigationGroup = 'Customer Management';

    /**
     * @throws Exception
     */
    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return TenantForm::form($schema);
    }

    /**
     * @throws Exception
     */
    #[\Override]
    public static function table(Table $table): Table
    {
        return TenantTable::columns($table)
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
            MaintenanceRelationManager::class,
            LeaseAgreementRelationManager::class,
            ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTenants::route('/'),
            'create' => CreateTenant::route('/create'),
            'edit' => EditTenant::route('/{record}/edit'),
        ];
    }
}
