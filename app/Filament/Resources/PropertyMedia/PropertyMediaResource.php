<?php

namespace App\Filament\Resources\PropertyMedia;

use App\Filament\Resources\PropertyMedia\Pages\CreatePropertyMedia;
use App\Filament\Resources\PropertyMedia\Pages\EditPropertyMedia;
use App\Filament\Resources\PropertyMedia\Pages\ListPropertyMedia;
use App\Filament\Resources\PropertyMedia\RelationManagers\PropertyRelationManager;
use App\Filament\ReusableResources\ResourceForm\PropertyMediaForm;
use App\Filament\ReusableResources\ResourceTable\PropertyMediaTable;
use App\Models\PropertyMedia;
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

class PropertyMediaResource extends Resource
{
    protected static ?string $model = PropertyMedia::class;

    public static ?string $tenantOwnershipRelationshipName = 'relationships';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

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
            AuditsRelationManager::class,
            PropertyRelationManager::class,
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
