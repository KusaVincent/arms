<?php

namespace App\Filament\Resources\Properties;

use App\Filament\Resources\Properties\Pages\CreateProperty;
use App\Filament\Resources\Properties\Pages\EditProperty;
use App\Filament\Resources\Properties\Pages\ListProperties;
use App\Filament\Resources\Properties\RelationManagers\AmenitiesRelationManager;
use App\Filament\Resources\Properties\RelationManagers\LeaseAgreementsRelationManager;
use App\Filament\Resources\Properties\RelationManagers\LocationRelationManager;
use App\Filament\Resources\Properties\RelationManagers\MaintenanceRelationManager;
use App\Filament\Resources\Properties\RelationManagers\PropertyMediaRelationManager;
use App\Filament\Resources\Properties\RelationManagers\PropertyTypeRelationManager;
use App\Filament\ReusableResources\ResourceForm\PropertyForm;
use App\Filament\ReusableResources\ResourceTable\PropertyTable;
use App\Models\Property;
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

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    /**
     * @throws Exception
     */
    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return PropertyForm::form($schema);
    }

    /**
     * @throws Exception
     */
    #[\Override]
    public static function table(Table $table): Table
    {
        return PropertyTable::columns($table)
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
            AmenitiesRelationManager::class,
            LocationRelationManager::class,
            PropertyTypeRelationManager::class,
            PropertyMediaRelationManager::class,
            LeaseAgreementsRelationManager::class,
            MaintenanceRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProperties::route('/'),
            'create' => CreateProperty::route('/create'),
            'edit' => EditProperty::route('/{record}/edit'),
        ];
    }
}
