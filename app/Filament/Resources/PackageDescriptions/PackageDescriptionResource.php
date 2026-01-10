<?php

namespace App\Filament\Resources\PackageDescriptions;

use AlizHarb\ActivityLog\RelationManagers\ActivitiesRelationManager;
use App\Filament\Resources\PackageDescriptions\Pages\CreatePackageDescription;
use App\Filament\Resources\PackageDescriptions\Pages\EditPackageDescription;
use App\Filament\Resources\PackageDescriptions\Pages\ListPackageDescriptions;
use App\Filament\Resources\PackageDescriptions\Pages\ViewPackageDescription;
use App\Filament\Resources\PackageDescriptions\RelationManagers\SubscriptionPackagesRelationManager;
use App\Filament\Resources\PackageDescriptions\Schemas\PackageDescriptionForm;
use App\Filament\Resources\PackageDescriptions\Schemas\PackageDescriptionInfolist;
use App\Filament\Resources\PackageDescriptions\Tables\PackageDescriptionsTable;
use App\Models\PackageDescription;
use App\Traits\HasSharedResourceProperties;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class PackageDescriptionResource extends Resource
{
    use HasSharedResourceProperties;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $model = PackageDescription::class;

    protected static string|null|\UnitEnum $navigationGroup = 'Subscription Management';

    public static function form(Schema $schema): Schema
    {
        return PackageDescriptionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PackageDescriptionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PackageDescriptionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            SubscriptionPackagesRelationManager::class,
            ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPackageDescriptions::route('/'),
            'create' => CreatePackageDescription::route('/create'),
            'view' => ViewPackageDescription::route('/{record}'),
            'edit' => EditPackageDescription::route('/{record}/edit'),
        ];
    }
}
