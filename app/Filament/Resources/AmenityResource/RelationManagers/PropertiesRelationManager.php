<?php

namespace App\Filament\Resources\AmenityResource\RelationManagers;

use App\Filament\ReusableResources\ReusablePropertyResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PropertiesRelationManager extends RelationManager
{
    protected static string $relationship = 'properties';

    public function form(Form $form): Form
    {
        return ReusablePropertyResource::form($form);
    }

    public function table(Table $table): Table
    {
        return ReusablePropertyResource::columns($table)
            ->recordTitleAttribute('name')
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
