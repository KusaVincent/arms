<?php

namespace App\Filament\Resources\TenantResource\RelationManagers;

use App\Filament\ReusableResources\ReusableMaintenanceResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MaintenanceRelationManager extends RelationManager
{
    protected static string $relationship = 'maintenance';

    public function form(Form $form): Form
    {
        return ReusableMaintenanceResource::form($form);
    }

    public function table(Table $table): Table
    {
        return ReusableMaintenanceResource::columns($table)
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
