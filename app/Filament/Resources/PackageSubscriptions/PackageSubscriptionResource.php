<?php

namespace App\Filament\Resources\PackageSubscriptions;

use AlizHarb\ActivityLog\RelationManagers\ActivitiesRelationManager;
use App\Filament\Resources\PackageSubscriptions\Pages\CreatePackageSubscription;
use App\Filament\Resources\PackageSubscriptions\Pages\EditPackageSubscription;
use App\Filament\Resources\PackageSubscriptions\Pages\ListPackageSubscriptions;
use App\Filament\Resources\PackageSubscriptions\Pages\ViewPackageSubscription;
use App\Filament\Resources\PackageSubscriptions\RelationManagers\PackageDescriptionRelationManager;
use App\Filament\Resources\PackageSubscriptions\RelationManagers\PaymentRelationManager;
use App\Filament\Resources\PackageSubscriptions\RelationManagers\UsersRelationManager;
use App\Filament\Resources\PackageSubscriptions\Schemas\PackageSubscriptionForm;
use App\Filament\Resources\PackageSubscriptions\Schemas\PackageSubscriptionInfolist;
use App\Filament\Resources\PackageSubscriptions\Tables\PackageSubscriptionsTable;
use App\Models\PackageSubscription;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PackageSubscriptionResource extends Resource
{
    protected static ?string $model = PackageSubscription::class;

    protected static string|null|\UnitEnum $navigationGroup = 'Subscription Management';

    public static function form(Schema $schema): Schema
    {
        return PackageSubscriptionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PackageSubscriptionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PackageSubscriptionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
            PaymentRelationManager::class,
            PackageDescriptionRelationManager::class,
            ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPackageSubscriptions::route('/'),
            'create' => CreatePackageSubscription::route('/create'),
            'view' => ViewPackageSubscription::route('/{record}'),
            'edit' => EditPackageSubscription::route('/{record}/edit'),
        ];
    }
}
