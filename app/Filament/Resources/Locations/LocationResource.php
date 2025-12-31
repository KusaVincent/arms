<?php

namespace App\Filament\Resources\Locations;

use AlizHarb\ActivityLog\RelationManagers\ActivitiesRelationManager;
use App\Filament\Resources\Locations\Pages\CreateLocation;
use App\Filament\Resources\Locations\Pages\EditLocation;
use App\Filament\Resources\Locations\Pages\ListLocations;
use App\Filament\Resources\Locations\RelationManagers\PropertiesRelationManager;
use App\Filament\ReusableResources\ResourceForm\LocationForm;
use App\Filament\ReusableResources\ResourceTable\LocationTable;
use App\Models\Location;
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

class LocationResource extends Resource
{
    use HasSharedResourceProperties;

    protected static ?int $navigationSort = 4;

    protected static ?string $model = Location::class;

    protected static ?string $recordTitleAttribute = 'full_address';

    protected static string|null|\UnitEnum $navigationGroup = 'Property Management';

    /**
     * @throws Exception
     */
    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return LocationForm::form($schema);
    }

    /**
     * @throws Exception
     */
    #[\Override]
    public static function table(Table $table): Table
    {
        return LocationTable::columns($table)
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
            PropertiesRelationManager::class,
            ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLocations::route('/'),
            'create' => CreateLocation::route('/create'),
            'edit' => EditLocation::route('/{record}/edit'),
        ];
    }
}
