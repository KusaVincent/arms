<?php

namespace App\Filament\Resources\ServiceAvailabilities;

use App\Filament\Resources\ServiceAvailabilities\Pages\ListServiceAvailabilities;
use App\Filament\Resources\ServiceAvailabilityResource\Pages;
use App\Filament\ReusableResources\ResourceForm\ServiceAvailabilityForm;
use App\Filament\ReusableResources\ResourceTable\ServiceAvailabilityTable;
use App\Models\ServiceAvailability;
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

class ServiceAvailabilityResource extends Resource
{
    protected static ?string $model = ServiceAvailability::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    /**
     * @throws Exception
     */
    public static function form(Schema $schema): Schema
    {
        return ServiceAvailabilityForm::form($schema);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return ServiceAvailabilityTable::columns($table)
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
            AuditsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServiceAvailabilities::route('/'),
            //            'create' => Pages\CreateServiceAvailability::route('/create'),
            //            'edit' => Pages\EditServiceAvailability::route('/{record}/edit'),
        ];
    }
}
