<?php

namespace App\Filament\Resources\PackageSubscriptions\RelationManagers;

use App\Filament\ReusableResources\ResourceTable\UserTable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'user';

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        return UserTable::columns($table)
            ->recordTitleAttribute('name')
            ->filters([])
            ->headerActions([])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
