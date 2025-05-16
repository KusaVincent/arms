<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyMediaResource\Pages;
use App\Filament\Resources\PropertyMediaResource\RelationManagers;
use App\Models\PropertyMedia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropertyMediaResource extends Resource
{
    protected static ?string $model = PropertyMedia::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('property_id')
                    ->required()
                    ->searchable()
                    ->columnSpanFull()
                    ->relationship('property', 'name'),
                Forms\Components\FileUpload::make('image_one')
                    ->required(),
                Forms\Components\FileUpload::make('image_two')
                    ->required(),
                Forms\Components\FileUpload::make('image_three')
                    ->required(),
                Forms\Components\FileUpload::make('image_four')
                    ->required(),
                Forms\Components\FileUpload::make('image_five')
                    ->required(),
                Forms\Components\FileUpload::make('video')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('property.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_one'),
                Tables\Columns\ImageColumn::make('image_two'),
                Tables\Columns\ImageColumn::make('image_three'),
                Tables\Columns\ImageColumn::make('image_four'),
                Tables\Columns\ImageColumn::make('image_five'),
            ])
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
            'index' => Pages\ListPropertyMedia::route('/'),
//            'create' => Pages\CreatePropertyMedia::route('/create'),
//            'edit' => Pages\EditPropertyMedia::route('/{record}/edit'),
        ];
    }
}
