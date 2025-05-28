<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerSupportResource\Pages;
use App\Filament\ReusableResources\ReusableCustomerSupportResource;
use App\Models\CustomerSupport;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomerSupportResource extends Resource
{
    protected static ?string $model = CustomerSupport::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return ReusableCustomerSupportResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return ReusableCustomerSupportResource::columns($table)
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomerSupports::route('/'),
            'create' => Pages\CreateCustomerSupport::route('/create'),
            'edit' => Pages\EditCustomerSupport::route('/{record}/edit'),
        ];
    }
}
