<?php

namespace App\Filament\Resources\PropertyTypes;

use App\Filament\Resources\PropertyTypeResource\Pages;
use App\Filament\Resources\PropertyTypes\Pages\EditPropertyType;
use App\Filament\Resources\PropertyTypes\Pages\ListPropertyTypes;
use App\Filament\Resources\PropertyTypes\RelationManagers\PropertiesRelationManager;
use App\Filament\ReusableResources\ResourceForm\PropertyTypeForm;
use App\Filament\ReusableResources\ResourceTable\PropertyTypeTable;
use App\Models\PropertyType;
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

class PropertyTypeResource extends Resource
{
    protected static ?string $model = PropertyType::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    /**
     * @throws Exception
     */
    public static function form(Schema $schema): Schema
    {
        return PropertyTypeForm::form($schema);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return PropertyTypeTable::columns($table)
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
            PropertiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPropertyTypes::route('/'),
            //            'create' => Pages\CreatePropertyType::route('/create'),
            'edit' => EditPropertyType::route('/{record}/edit'),
        ];
    }
}
