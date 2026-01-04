<?php

namespace App\Filament\Resources\Amenities;

use AlizHarb\ActivityLog\RelationManagers\ActivitiesRelationManager;
use App\Filament\Resources\Amenities\Pages\CreateAmenity;
use App\Filament\Resources\Amenities\Pages\EditAmenity;
use App\Filament\Resources\Amenities\Pages\ListAmenities;
use App\Filament\Resources\Amenities\RelationManagers\PropertiesRelationManager;
use App\Filament\Resources\Amenities\Schemas\AmenityForm;
use App\Filament\Resources\Amenities\Tables\AmenityTable;
use App\Models\Amenity;
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

class AmenityResource extends Resource
{
    use HasSharedResourceProperties;

    protected static ?int $navigationSort = 5;

    protected static ?string $model = Amenity::class;

    protected static ?string $recordTitleAttribute = 'amenity_name';

    protected static string|null|\UnitEnum $navigationGroup = 'Property Management';

    /**
     * @throws Exception
     */
    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return AmenityForm::configure($schema);
    }

    /**
     * @throws Exception
     */
    #[\Override]
    public static function table(Table $table): Table
    {
        return AmenityTable::configure($table)
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
            'index' => ListAmenities::route('/'),
            'create' => CreateAmenity::route('/create'),
            'edit' => EditAmenity::route('/{record}/edit'),
        ];
    }
}
