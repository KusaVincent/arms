<?php

namespace App\Filament\Resources\PackageDescriptions\RelationManagers;

use App\Filament\Resources\PackageSubscriptions\Tables\PackageSubscriptionsTable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class SubscriptionPackagesRelationManager extends RelationManager
{
    protected static string $relationship = 'subscriptionPackages';

    public function table(Table $table): Table
    {
        return PackageSubscriptionsTable::configure($table)
            ->recordTitleAttribute('mnemonic')
            ->filters([
                //
            ])
            ->headerActions([])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
