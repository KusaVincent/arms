<?php

namespace App\Filament\Resources\LeaseAgreements;

use App\Filament\Resources\LeaseAgreements\Pages\CreateLeaseAgreement;
use App\Filament\Resources\LeaseAgreements\Pages\EditLeaseAgreement;
use App\Filament\Resources\LeaseAgreements\Pages\ListLeaseAgreements;
use App\Filament\Resources\LeaseAgreements\RelationManagers\PaymentsRelationManager;
use App\Filament\Resources\LeaseAgreements\RelationManagers\PropertyRelationManager;
use App\Filament\Resources\LeaseAgreements\RelationManagers\TenantRelationManager;
use App\Filament\ReusableResources\ResourceForm\LeaseAgreementForm;
use App\Filament\ReusableResources\ResourceTable\LeaseAgreementTable;
use App\Models\LeaseAgreement;
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
use Tapp\FilamentAuditing\RelationManagers\AuditsRelationManager;

class LeaseAgreementResource extends Resource
{
    protected static ?string $model = LeaseAgreement::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    /**
     * @throws Exception
     */
    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return LeaseAgreementForm::form($schema);
    }

    /**
     * @throws Exception
     */
    #[\Override]
    public static function table(Table $table): Table
    {
        return LeaseAgreementTable::columns($table)
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
            AuditsRelationManager::class,
            TenantRelationManager::class,
            PropertyRelationManager::class,
            PaymentsRelationManager::class,
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
