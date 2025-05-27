<?php

namespace App\Filament\ReusableResources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReusablePropertyMediaResource
{
    protected static int $imageMaxSize = 5120;

    protected static string $imagePreviewHeight = '250';

    protected static string $directoryPath = 'property/images/';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Select::make('property_id')
                                    ->required()
                                    ->searchable()
                                    ->columnSpanFull()
                                    ->relationship('property', 'name'),
                            ]),
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\FileUpload::make('image_one')
                                    ->image()
                                    ->required()
                                    ->maxSize(self::$imageMaxSize)
                                    ->directory(self::$directoryPath)
                                    ->imagePreviewHeight(self::$imagePreviewHeight),
                                Forms\Components\FileUpload::make('image_two')
                                    ->image()
                                    ->maxSize(self::$imageMaxSize)
                                    ->directory(self::$directoryPath)
                                    ->imagePreviewHeight(self::$imagePreviewHeight),
                            ])->columns(),
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\FileUpload::make('image_three')
                                    ->image()
                                    ->maxSize(self::$imageMaxSize)
                                    ->directory(self::$directoryPath)
                                    ->imagePreviewHeight(self::$imagePreviewHeight),
                                Forms\Components\FileUpload::make('image_four')
                                    ->image()
                                    ->maxSize(self::$imageMaxSize)
                                    ->directory(self::$directoryPath)
                                    ->imagePreviewHeight(self::$imagePreviewHeight),
                            ])->columns(),
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\FileUpload::make('image_five')
                                    ->image()
                                    ->maxSize(self::$imageMaxSize)
                                    ->directory(self::$directoryPath)
                                    ->imagePreviewHeight(self::$imagePreviewHeight),
                                Forms\Components\FileUpload::make('video')
                                    ->reactive()
                                    ->maxSize(51200)
                                    ->directory(self::$directoryPath)
                                    ->acceptedFileTypes(['video/mp4', 'video/avi', 'video/mkv'])
                                    ->helperText(fn ($state) => $state
                                        ? '<video controls width="300"><source src="'.asset(self::$directoryPath.$state).'" type="video/mp4"></video>'
                                        : null
                                    ),
                            ])->columns(),
                    ]),
            ]);
    }

    public static function columns(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('property.name')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('image_one'),
                ImageColumn::make('image_two'),
                ImageColumn::make('image_three'),
                ImageColumn::make('image_four'),
                ImageColumn::make('image_five'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Added On')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Date Updated')
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
