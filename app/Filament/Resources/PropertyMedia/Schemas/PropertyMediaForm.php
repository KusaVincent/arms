<?php

namespace App\Filament\Resources\PropertyMedia\Schemas;

use App\Filament\ReusableResources\Common\SelectField;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PropertyMediaForm
{
    protected static int $imageMaxSize = 5120;
    protected static string $imagePreviewHeight = '250';
    protected static string $directoryPath = 'property/images';

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Property Gallery Management')
                    ->description('Organize high-resolution images and promotional videos for this listing.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Group::make([
                                    Section::make('High-Resolution Gallery')
                                        ->description('Upload up to five images to showcase the property interior and exterior.')
                                        ->icon('heroicon-m-photo')
                                        ->compact()
                                        ->schema([
                                            Grid::make(2)
                                                ->schema([
                                                    FileUpload::make('image_one')
                                                        ->label('Primary Image')
                                                        ->image()
                                                        ->required()
                                                        ->disk('public')
                                                        ->maxSize(self::$imageMaxSize)
                                                        ->directory(self::$directoryPath)
                                                        ->imagePreviewHeight(self::$imagePreviewHeight),

                                                    FileUpload::make('image_two')
                                                        ->label('Secondary Image')
                                                        ->image()
                                                        ->disk('public')
                                                        ->maxSize(self::$imageMaxSize)
                                                        ->directory(self::$directoryPath)
                                                        ->imagePreviewHeight(self::$imagePreviewHeight),

                                                    FileUpload::make('image_three')
                                                        ->label('Internal View 1')
                                                        ->image()
                                                        ->disk('public')
                                                        ->maxSize(self::$imageMaxSize)
                                                        ->directory(self::$directoryPath)
                                                        ->imagePreviewHeight(self::$imagePreviewHeight),

                                                    FileUpload::make('image_four')
                                                        ->label('Internal View 2')
                                                        ->image()
                                                        ->disk('public')
                                                        ->maxSize(self::$imageMaxSize)
                                                        ->directory(self::$directoryPath)
                                                        ->imagePreviewHeight(self::$imagePreviewHeight),

                                                    FileUpload::make('image_five')
                                                        ->label('Additional View')
                                                        ->image()
                                                        ->disk('public')
                                                        ->maxSize(self::$imageMaxSize)
                                                        ->directory(self::$directoryPath)
                                                        ->imagePreviewHeight(self::$imagePreviewHeight)
                                                        ->columnSpanFull(),
                                                ]),
                                        ]),
                                ])->columnSpan(2),

                                Group::make([
                                    Section::make('Property Link')
                                        ->icon('heroicon-m-link')
                                        ->compact()
                                        ->schema([
                                            SelectField::make('property_id')
                                                ->label('Select Property')
                                                ->required()
                                                ->relationship('property', 'name')
                                                ->searchable()
                                                ->preload(),
                                        ]),

                                    Section::make('Video Tour')
                                        ->icon('heroicon-m-video-camera')
                                        ->compact()
                                        ->schema([
                                            FileUpload::make('video')
                                                ->hiddenLabel()
                                                ->maxSize(10240)
                                                ->disk('public')
                                                ->panelAspectRatio('16:9')
                                                ->directory(self::$directoryPath)
                                                ->acceptedFileTypes(['video/mp4', 'video/avi', 'video/mkv']),
                                        ]),

                                    Section::make('Audit Information')
                                        ->icon('heroicon-m-clock')
                                        ->compact()
                                        ->visible(fn ($livewire) => $livewire instanceof EditRecord)
                                        ->schema([
                                            DateTimePicker::make('created_at')
                                                ->label('Uploaded On')
                                                ->disabled()
                                                ->dehydrated(false),

                                            DateTimePicker::make('updated_at')
                                                ->label('Last Modified')
                                                ->disabled()
                                                ->dehydrated(false),
                                        ]),
                                ])->columnSpan(1),
                            ]),
                    ]),
            ]);
    }
}
