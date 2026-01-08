<?php

namespace App\Filament\Resources\Properties;

use AlizHarb\ActivityLog\RelationManagers\ActivitiesRelationManager;
use App\Filament\Resources\Properties\Pages\CreateProperty;
use App\Filament\Resources\Properties\Pages\EditProperty;
use App\Filament\Resources\Properties\Pages\ListProperties;
use App\Filament\Resources\Properties\Pages\ViewProperty;
use App\Filament\Resources\Properties\RelationManagers\AmenitiesRelationManager;
use App\Filament\Resources\Properties\RelationManagers\LeaseAgreementsRelationManager;
use App\Filament\Resources\Properties\RelationManagers\LocationRelationManager;
use App\Filament\Resources\Properties\RelationManagers\MaintenanceRelationManager;
use App\Filament\Resources\Properties\RelationManagers\OperatorsRelationManager;
use App\Filament\Resources\Properties\RelationManagers\PropertyMediaRelationManager;
use App\Filament\Resources\Properties\RelationManagers\PropertyTypeRelationManager;
use App\Filament\Resources\Properties\Schemas\PropertyForm;
use App\Filament\Resources\Properties\Schemas\PropertyInfolist;
use App\Filament\Resources\Properties\Tables\PropertyTable;
use App\Models\Property;
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
use pxlrbt\FilamentExcel\Actions\ExportBulkAction;

class PropertyResource extends Resource
{
    use HasSharedResourceProperties;

    protected static ?int $navigationSort = 1;

    protected static ?string $model = Property::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static string|null|\UnitEnum $navigationGroup = 'Property Management';

    /**
     * @throws Exception
     */
    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return PropertyForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PropertyInfolist::configure($schema);
    }

    /**
     * @throws Exception
     */
    #[\Override]
    public static function table(Table $table): Table
    {
        return PropertyTable::configure($table)
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
                    ExportBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    #[\Override]
    public static function getRelations(): array
    {
        return [
            OperatorsRelationManager::class,
            AmenitiesRelationManager::class,
            LocationRelationManager::class,
            PropertyTypeRelationManager::class,
            PropertyMediaRelationManager::class,
            LeaseAgreementsRelationManager::class,
            MaintenanceRelationManager::class,
            ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProperties::route('/'),
            'create' => CreateProperty::route('/create'),
            'view' => ViewProperty::route('/{record}'),
            'edit' => EditProperty::route('/{record}/edit'),
        ];
    }
}
