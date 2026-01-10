<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Enums\PropertyAvailable;
use App\Enums\PropertyNegotiable;
use App\Filament\ReusableResources\Common\MoneyField;
use App\Filament\ReusableResources\Common\SelectField;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class PropertyForm
{
    protected static int $imageMaxSize = 5120;
    protected static string $directoryPath = 'property/images';

    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Property Management')
                ->description('Comprehensive configuration for real estate listings, pricing, and availability.')
                ->schema([
                    Grid::make(3)
                        ->schema([
                            Group::make([
                                Section::make('Core Details')
                                    ->icon('heroicon-m-home')
                                    ->compact()
                                    ->schema([
                                        TextInput::make('name')
                                            ->required()
                                            ->placeholder('e.g. Luxury 3BHK Apartment')
                                            ->maxLength(255),

                                        SelectField::make('property_type_id')
                                            ->label('Property Type')
                                            ->relationship('propertyType', 'type_name')
                                            ->searchable()
                                            ->preload()
                                            ->required(),
                                    ])->columns(2),

                                Section::make('Location & Description')
                                    ->icon('heroicon-m-map-pin')
                                    ->compact()
                                    ->schema([
                                        SelectField::make('location_id')
                                            ->label('Exact Location')
                                            ->relationship('location', 'full_address')
                                            ->searchable()
                                            ->required(),

                                        MarkdownEditor::make('description')
                                            ->label('Property Description')
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Financial Terms')
                                    ->icon('heroicon-m-banknotes')
                                    ->compact()
                                    ->schema([
                                        MoneyField::make('rent')
                                            ->rules(['numeric']),
                                        MoneyField::make('deposit')
                                            ->rules(['numeric']),

                                        SelectField::make('negotiable')
                                            ->label('Negotiable')
                                            ->options(PropertyNegotiable::class)
                                            ->default(false),
                                    ])->columns(3),
                            ])->columnSpan(2),

                            Group::make([
                                Section::make('Status & Visibility')
                                    ->icon('heroicon-m-eye')
                                    ->compact()
                                    ->schema([
                                        SelectField::make('available')
                                            ->label('Availability Status')
                                            ->options(PropertyAvailable::class)
                                            ->visible(fn ($livewire) => ! $livewire instanceof CreateRecord),
                                    ]),

                                Section::make('Property Image')
                                    ->icon('heroicon-m-photo')
                                    ->compact()
                                    ->schema([
                                        FileUpload::make('property_image')
                                            ->hiddenLabel()
                                            ->image()
                                            ->imageEditor()
                                            ->circleCropper()
                                            ->disk('public')
                                            ->directory(self::$directoryPath)
                                            ->maxSize(self::$imageMaxSize),
                                    ]),

                                Section::make('System Metadata')
                                    ->icon('heroicon-m-information-circle')
                                    ->compact()
                                    ->visible(fn ($livewire) => ! $livewire instanceof CreateRecord)
                                    ->schema([
                                        DateTimePicker::make('created_at')
                                            ->label('Listing Created')
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
