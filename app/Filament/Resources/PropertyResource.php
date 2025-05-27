<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers\AmenitiesRelationManager;
use App\Filament\Resources\PropertyResource\RelationManagers\LocationRelationManager;
use App\Filament\Resources\PropertyResource\RelationManagers\PropertyMediaRelationManager;
use App\Filament\Resources\PropertyResource\RelationManagers\PropertyTypeRelationManager;
use App\Filament\ReusableResources\ReusablePropertyResource;
use App\Models\Property;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return ReusablePropertyResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return ReusablePropertyResource::columns($table)
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
            AmenitiesRelationManager::class,
            LocationRelationManager::class,
            PropertyTypeRelationManager::class,
            PropertyMediaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}
