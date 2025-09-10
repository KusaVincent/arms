<?php

namespace App\Filament\ReusableResources\ResourceForm;

use Exception;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PropertyMediaForm
{
    protected static int $imageMaxSize = 5120;

    protected static string $imagePreviewHeight = '250';

    protected static string $directoryPath = 'property/images';

    /**
     * @throws Exception
     */
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Select::make('property_id')
                                    ->required()
                                    ->searchable()
                                    ->columnSpanFull()
                                    ->relationship('property', 'name'),
                            ]),
                        Section::make()
                            ->schema([
                                FileUpload::make('image_one')
                                    ->image()
                                    ->required()
                                    ->disk('public')
                                    ->maxSize(self::$imageMaxSize)
                                    ->directory(self::$directoryPath)
                                    ->imagePreviewHeight(self::$imagePreviewHeight),
                                FileUpload::make('image_two')
                                    ->image()
                                    ->disk('public')
                                    ->maxSize(self::$imageMaxSize)
                                    ->directory(self::$directoryPath)
                                    ->imagePreviewHeight(self::$imagePreviewHeight),
                            ])->columns(),
                        Section::make()
                            ->schema([
                                FileUpload::make('image_three')
                                    ->image()
                                    ->disk('public')
                                    ->maxSize(self::$imageMaxSize)
                                    ->directory(self::$directoryPath)
                                    ->imagePreviewHeight(self::$imagePreviewHeight),
                                FileUpload::make('image_four')
                                    ->image()
                                    ->disk('public')
                                    ->maxSize(self::$imageMaxSize)
                                    ->directory(self::$directoryPath)
                                    ->imagePreviewHeight(self::$imagePreviewHeight),
                            ])->columns(),
                        Section::make()
                            ->schema([
                                FileUpload::make('image_five')
                                    ->image()
                                    ->disk('public')
                                    ->maxSize(self::$imageMaxSize)
                                    ->directory(self::$directoryPath)
                                    ->imagePreviewHeight(self::$imagePreviewHeight),
                                FileUpload::make('video')
                                    ->reactive()
                                    ->maxSize(51200)
                                    ->disk('public')
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
}
