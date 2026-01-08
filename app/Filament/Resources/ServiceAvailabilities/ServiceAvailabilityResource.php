<?php

namespace App\Filament\Resources\ServiceAvailabilities;

use AlizHarb\ActivityLog\RelationManagers\ActivitiesRelationManager;
use App\Filament\Resources\ServiceAvailabilities\Pages\CreateServiceAvailability;
use App\Filament\Resources\ServiceAvailabilities\Pages\EditServiceAvailability;
use App\Filament\Resources\ServiceAvailabilities\Pages\ListServiceAvailabilities;
use App\Filament\Resources\ServiceAvailabilities\Pages\ViewServiceAvailability;
use App\Filament\Resources\ServiceAvailabilities\Schemas\ServiceAvailabilityForm;
use App\Filament\Resources\ServiceAvailabilities\Schemas\ServiceAvailabilityInfolist;
use App\Filament\Resources\ServiceAvailabilities\Tables\ServiceAvailabilityTable;
use App\Models\ServiceAvailability;
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

class ServiceAvailabilityResource extends Resource
{
    use HasSharedResourceProperties;

    protected static ?string $model = ServiceAvailability::class;

    protected static ?string $recordTitleAttribute = 'service_name';

    protected static string|null|\UnitEnum $navigationGroup = 'Settings';

    /**
     * @throws Exception
     */
    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return ServiceAvailabilityForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ServiceAvailabilityInfolist::configure($schema);
    }


    /**
     * @throws Exception
     */
    #[\Override]
    public static function table(Table $table): Table
    {
        return ServiceAvailabilityTable::configure($table)
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
            ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServiceAvailabilities::route('/'),
            'create' => CreateServiceAvailability::route('/create'),
            'view' => ViewServiceAvailability::route('/{record}'),
            'edit' => EditServiceAvailability::route('/{record}/edit'),
        ];
    }
}
