<?php

namespace App\Filament\Resources\PropertyMedia;

use AlizHarb\ActivityLog\RelationManagers\ActivitiesRelationManager;
use App\Filament\Resources\PropertyMedia\Pages\CreatePropertyMedia;
use App\Filament\Resources\PropertyMedia\Pages\EditPropertyMedia;
use App\Filament\Resources\PropertyMedia\Pages\ListPropertyMedia;
use App\Filament\Resources\PropertyMedia\RelationManagers\PropertyRelationManager;
use App\Filament\ReusableResources\ResourceForm\PropertyMediaForm;
use App\Filament\ReusableResources\ResourceTable\PropertyMediaTable;
use App\Models\PropertyMedia;
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

class PropertyMediaResource extends Resource
{
    use HasSharedResourceProperties;

    protected static ?int $navigationSort = 2;

    protected static ?string $model = PropertyMedia::class;

    protected static ?string $recordTitleAttribute = 'property_name';

    protected static string|null|\UnitEnum $navigationGroup = 'Property Management';

    /**
     * @throws Exception
     */
    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return PropertyMediaForm::form($schema);
    }

    /**
     * @throws Exception
     */
    #[\Override]
    public static function table(Table $table): Table
    {
        return PropertyMediaTable::columns($table)
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
            PropertyRelationManager::class,
            ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPropertyMedia::route('/'),
            'create' => CreatePropertyMedia::route('/create'),
            'edit' => EditPropertyMedia::route('/{record}/edit'),
        ];
    }
}
