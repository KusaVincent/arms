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
                    ->image()
                    ->required()
                    ->maxSize(5120)
                    ->imagePreviewHeight('250')
                    ->directory('property/images/'),
                Forms\Components\FileUpload::make('image_two')
                    ->image()
                    ->maxSize(5120)
                    ->imagePreviewHeight('250')
                    ->directory('property/images/'),
                Forms\Components\FileUpload::make('image_three')
                    ->image()
                    ->maxSize(5120)
                    ->imagePreviewHeight('250')
                    ->directory('property/images/'),
                Forms\Components\FileUpload::make('image_four')
                    ->image()
                    ->maxSize(5120)
                    ->imagePreviewHeight('250')
                    ->directory('property/images/'),
                Forms\Components\FileUpload::make('image_five')
                    ->image()
                    ->maxSize(5120)
                    ->imagePreviewHeight('250')
                    ->directory('property/images/'),
                Forms\Components\FileUpload::make('video')
                    ->reactive()
                    ->maxSize(51200)
                    ->directory('property/videos/')
                    ->acceptedFileTypes(['video/mp4', 'video/avi', 'video/mkv'])
                    ->helperText(fn ($state) => $state
                        ? '<video controls width="300"><source src="' . asset('property/videos/' . $state) . '" type="video/mp4"></video>'
                        : null
                    )
                ,
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
            'index' => Pages\ListPropertyMedia::route('/'),
//            'create' => Pages\CreatePropertyMedia::route('/create'),
//            'edit' => Pages\EditPropertyMedia::route('/{record}/edit'),
        ];
    }
}
