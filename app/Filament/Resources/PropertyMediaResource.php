<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyMediaResource\Pages;
use App\Filament\Resources\PropertyMediaResource\RelationManagers\PropertyRelationManager;
use App\Filament\ReusableResources\ReusablePropertyMediaResource;
use App\Models\PropertyMedia;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PropertyMediaResource extends Resource
{
    protected static ?string $model = PropertyMedia::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return ReusablePropertyMediaResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return ReusablePropertyMediaResource::columns($table)
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
            PropertyRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPropertyMedia::route('/'),
            'create' => Pages\CreatePropertyMedia::route('/create'),
            'edit' => Pages\EditPropertyMedia::route('/{record}/edit'),
        ];
    }
}
