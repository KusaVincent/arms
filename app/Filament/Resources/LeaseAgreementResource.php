<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaseAgreementResource\Pages;
use App\Filament\Resources\LeaseAgreementResource\RelationManagers\PropertyRelationManager;
use App\Filament\Resources\LeaseAgreementResource\RelationManagers\TenantRelationManager;
use App\Filament\ReusableResources\ReusableLeaseAgreementResource;
use App\Models\LeaseAgreement;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LeaseAgreementResource extends Resource
{
    protected static ?string $model = LeaseAgreement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return ReusableLeaseAgreementResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return ReusableLeaseAgreementResource::columns($table)
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TenantRelationManager::class,
            PropertyRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeaseAgreements::route('/'),
            'create' => Pages\CreateLeaseAgreement::route('/create'),
            'edit' => Pages\EditLeaseAgreement::route('/{record}/edit'),
        ];
    }
}
