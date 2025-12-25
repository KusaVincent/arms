<?php

namespace App\Filament\Resources\SubscriptionPackages\RelationManagers;

use App\Enums\PackagePublished;
use App\Enums\PackageStatus;
use App\Filament\Resources\PackageDescriptions\Tables\PackageDescriptionsTable;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
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
