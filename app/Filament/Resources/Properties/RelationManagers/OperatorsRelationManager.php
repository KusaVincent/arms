<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use App\Filament\Resources\Operators\Schemas\OperatorForm;
use App\Filament\Resources\Operators\Tables\OperatorsTable;
use Exception;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class OperatorsRelationManager extends RelationManager
{
    protected static string $relationship = 'operators';

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return OperatorForm::configure($schema);
    }

    /**
     * @throws Exception
     */
    public function table(Table $table): Table
    {
        return OperatorsTable::configure($table)
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
