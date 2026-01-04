<?php

namespace App\Filament\Resources\PackageSubscriptions\RelationManagers;

use App\Filament\Resources\Operators\Tables\OperatorsTable;
use App\Filament\Resources\Users\Tables\UserTable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class OperatorsRelationManager extends RelationManager
{
    protected static string $relationship = 'operator';

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        return OperatorsTable::configure($table)
            ->recordTitleAttribute('name')
            ->filters([])
            ->headerActions([])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
