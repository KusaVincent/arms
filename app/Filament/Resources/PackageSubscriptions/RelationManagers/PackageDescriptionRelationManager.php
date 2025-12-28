<?php

namespace App\Filament\Resources\PackageSubscriptions\RelationManagers;

use App\Filament\Resources\PackageDescriptions\Tables\PackageDescriptionsTable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class PackageDescriptionRelationManager extends RelationManager
{
    protected static string $relationship = 'packageDescription';

    public function table(Table $table): Table
    {
        return PackageDescriptionsTable::configure($table)
            ->recordTitleAttribute('name')
            ->filters([
                //
            ])
            ->headerActions([])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
