<?php

namespace App\Filament\ReusableResources\ResourceForm;

use App\Filament\Resources\Common\SelectField;
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
                                SelectField::make('property_id')
                                    ->required()
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
                                    ->maxSize(10240)
                                    ->disk('public')
                                    ->panelAspectRatio('16:9')
                                    ->directory(self::$directoryPath)
                                    ->panelLayout('integrated')
                                    ->imagePreviewHeight('250')
                                    ->loadingIndicatorPosition('left')
                                    ->acceptedFileTypes(['video/mp4', 'video/avi', 'video/mkv'])
                                    ->validationMessages(['max' => 'The video must not be larger than 10MB.']),
                            ])->columns(),
                    ]),
            ]);
    }
}
