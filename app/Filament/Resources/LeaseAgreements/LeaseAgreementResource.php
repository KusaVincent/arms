<?php

namespace App\Filament\Resources\LeaseAgreements;

use AlizHarb\ActivityLog\RelationManagers\ActivitiesRelationManager;
use App\Filament\Resources\LeaseAgreements\Pages\CreateLeaseAgreement;
use App\Filament\Resources\LeaseAgreements\Pages\EditLeaseAgreement;
use App\Filament\Resources\LeaseAgreements\Pages\ListLeaseAgreements;
use App\Filament\Resources\LeaseAgreements\RelationManagers\PaymentsRelationManager;
use App\Filament\Resources\LeaseAgreements\RelationManagers\PropertyRelationManager;
use App\Filament\Resources\LeaseAgreements\RelationManagers\TenantRelationManager;
use App\Filament\Resources\LeaseAgreements\Schemas\LeaseAgreementForm;
use App\Filament\Resources\LeaseAgreements\Tables\LeaseAgreementTable;
use App\Models\LeaseAgreement;
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

class LeaseAgreementResource extends Resource
{
    use HasSharedResourceProperties;

    protected static ?int $navigationSort = 6;

    protected static ?string $model = LeaseAgreement::class;

    protected static ?string $recordTitleAttribute = 'tenant_name';

    protected static string|null|\UnitEnum $navigationGroup = 'Property Management';

    /**
     * @throws Exception
     */
    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return LeaseAgreementForm::configure($schema);
    }

    /**
     * @throws Exception
     */
    #[\Override]
    public static function table(Table $table): Table
    {
        return LeaseAgreementTable::configure($table)
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
            PaymentsRelationManager::class,
            ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLeaseAgreements::route('/'),
            'create' => CreateLeaseAgreement::route('/create'),
            'edit' => EditLeaseAgreement::route('/{record}/edit'),
        ];
    }
}
