<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AmenityResource\Pages;
use App\Models\Amenity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AmenityResource extends Resource
{
    protected static ?string $model = Amenity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('amenity_name')
                    ->required()
                    ->columns(3),
                Forms\Components\TextInput::make('amenity_icon')
                    ->required()
                    ->columns(3),
                Forms\Components\TextInput::make('amenity_icon_color')
                    ->required()
                    ->columns(3),
                Forms\Components\MarkdownEditor::make('amenity_description')
                    ->required()
                    ->columnSpan(3)
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('amenity_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('amenity_icon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amenity_icon_color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amenity_description')
                    ->searchable()
                    ->limit(15),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ListAmenities::route('/'),
            //            'create' => Pages\CreateAmenity::route('/create'),
            //            'edit' => Pages\EditAmenity::route('/{record}/edit'),
        ];
    }
}
