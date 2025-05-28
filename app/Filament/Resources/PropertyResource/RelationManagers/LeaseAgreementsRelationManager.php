<?php

namespace App\Filament\Resources\PropertyResource\RelationManagers;

use App\Filament\ReusableResources\ReusableLeaseAgreementResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeaseAgreementsRelationManager extends RelationManager
{
    protected static string $relationship = 'leaseAgreements';

    public function form(Form $form): Form
    {
        return ReusableLeaseAgreementResource::form($form);
    }

    public function table(Table $table): Table
    {
        return ReusableLeaseAgreementResource::columns($table)
            ->recordTitleAttribute('tenant.first_name')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
