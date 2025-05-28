<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceAvailabilityResource\Pages;
use App\Filament\ReusableResources\ReusableServiceAvailabilityResource;
use App\Models\ServiceAvailability;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceAvailabilityResource extends Resource
{
    protected static ?string $model = ServiceAvailability::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return ReusableServiceAvailabilityResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return ReusableServiceAvailabilityResource::columns($table)
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
            'index' => Pages\ListServiceAvailabilities::route('/'),
            //            'create' => Pages\CreateServiceAvailability::route('/create'),
            //            'edit' => Pages\EditServiceAvailability::route('/{record}/edit'),
        ];
    }
}
