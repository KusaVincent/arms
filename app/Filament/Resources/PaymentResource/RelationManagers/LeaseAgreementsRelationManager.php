<?php

namespace App\Filament\Resources\PaymentResource\RelationManagers;

use App\Filament\ReusableResources\ReusableLeaseAgreementResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class LeaseAgreementsRelationManager extends RelationManager
{
    protected static string $relationship = 'leaseAgreement';

    public function form(Form $form): Form
    {
        return ReusableLeaseAgreementResource::form($form);
    }

    public function table(Table $table): Table
    {
        return ReusableLeaseAgreementResource::columns($table)
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
