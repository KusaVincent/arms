<?php

namespace App\Filament\Resources\PackageDescriptions\RelationManagers;

use App\Filament\Resources\PackageSubscriptions\Tables\PackageSubscriptionsTable;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
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
