<?php

namespace App\Filament\Resources\PropertyResource\RelationManagers;

use App\Filament\ReusableResources\ReusablePropertyMediaResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PropertyMediaRelationManager extends RelationManager
{
    protected static string $relationship = 'PropertyMedia';

    public function form(Form $form): Form
    {
        return ReusablePropertyMediaResource::form($form);
    }

    public function table(Table $table): Table
    {
        return ReusablePropertyMediaResource::columns($table)
            ->recordTitleAttribute('property.name')
            ->filters([
                //
            ])
            ->headerActions([
                //                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
