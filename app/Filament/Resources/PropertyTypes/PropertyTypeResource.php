<?php

namespace App\Filament\Resources\PropertyTypes;

use AlizHarb\ActivityLog\RelationManagers\ActivitiesRelationManager;
use App\Filament\Resources\PropertyTypes\Pages\EditPropertyType;
use App\Filament\Resources\PropertyTypes\Pages\ListPropertyTypes;
use App\Filament\Resources\PropertyTypes\Pages\ViewPropertyType;
use App\Filament\Resources\PropertyTypes\RelationManagers\PropertiesRelationManager;
use App\Filament\Resources\PropertyTypes\Schemas\PropertyTypeForm;
use App\Filament\Resources\PropertyTypes\Schemas\PropertyTypeInfolist;
use App\Filament\Resources\PropertyTypes\Tables\PropertyTypeTable;
use App\Models\PropertyType;
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

class PropertyTypeResource extends Resource
{
    use HasSharedResourceProperties;

    protected static ?int $navigationSort = 3;

    protected static ?string $model = PropertyType::class;

    protected static ?string $recordTitleAttribute = 'type_name';

    protected static string|null|\UnitEnum $navigationGroup = 'Property Management';

    /**
     * @throws Exception
     */
    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return PropertyTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PropertyTypeInfolist::configure($schema);
    }

    /**
     * @throws Exception
     */
    #[\Override]
    public static function table(Table $table): Table
    {
        return PropertyTypeTable::configure($table)
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
            'index' => ListPropertyTypes::route('/'),
            'create' => Pages\CreatePropertyType::route('/create'),
            'view' => ViewPropertyType::route('/{record}'),
            'edit' => EditPropertyType::route('/{record}/edit'),
        ];
    }
}
