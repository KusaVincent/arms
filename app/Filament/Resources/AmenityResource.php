<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AmenityResource\Pages;
use App\Filament\Resources\AmenityResource\RelationManagers\PropertiesRelationManager;
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
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Section::make('')
                            ->schema([
                                Forms\Components\TextInput::make('amenity_name')
                                    ->required()
                                    ->label('Name'),
                                Forms\Components\TextInput::make('amenity_icon')
                                    ->required()
                                    ->label('Icon'),
                                Forms\Components\TextInput::make('amenity_icon_color')
                                    ->required()
                                    ->label('Color'),
                            ])->columnSpan(3)->columns(3),
                        Forms\Components\Section::make('')
                            ->schema([
                                Forms\Components\MarkdownEditor::make('amenity_description')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Description'),
                            ])->columnSpan(3),
                    ]),
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
                    ->dateTime()
                    ->label('Added On')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Date Updated')
                    ->toggleable(isToggledHiddenByDefault: true),
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
            PropertiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAmenities::route('/'),
            'create' => Pages\CreateAmenity::route('/create'),
            'edit' => Pages\EditAmenity::route('/{record}/edit'),
        ];
    }
}
