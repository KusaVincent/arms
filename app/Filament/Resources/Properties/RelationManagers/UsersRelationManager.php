<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Filament\Resources\Properties\PropertyResource;
use App\Filament\ReusableResources\ResourceForm\UserForm;
use App\Filament\ReusableResources\ResourceTable\UserTable;
use Exception;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

//    protected static ?string $relatedResource = PropertyResource::class;

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return UserForm::form($schema);
    }

    /**
     * @throws Exception
     */

    public function table(Table $table): Table
    {
        return UserTable::columns($table)
            ->recordTitleAttribute('name')
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->recordSelect(function (Select $select) {
                        return $select
                            ->searchable()
                            ->preload();
                    })
                    ->using(fn () => [
                        'created_by' => auth()->id(),
                    ]),
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
