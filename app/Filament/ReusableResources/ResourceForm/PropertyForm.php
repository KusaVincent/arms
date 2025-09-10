<?php

namespace App\Filament\ReusableResources\ResourceForm;

use App\Enums\PropertyAvailable;
use App\Enums\PropertyNegotiable;
use App\Utils\SanitizationHelper;
use Exception;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PropertyForm
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
                        Group::make()
                            ->schema([
                                Section::make()
                                    ->schema([
                                        TextInput::make('name')
                                            ->required(),
                                        Select::make('property_type_id')
                                            ->required()
                                            ->searchable()
                                            ->label('Property Type')
                                            ->relationship('propertyType', 'type_name'),
                                    ])->columns(),
                                Section::make()
                                    ->schema([
                                        TextInput::make('rent')
                                            ->required()
                                            ->formatStateUsing(fn ($state, $livewire) => $livewire instanceof EditRecord
                                                ? SanitizationHelper::stripFormatting($state)
                                                : $state
                                            )
                                            ->dehydrateStateUsing(fn ($state) => $state)
                                            ->rules(fn ($livewire): array => $livewire instanceof ViewRecord ? [] : ['numeric']),
                                        TextInput::make('deposit')
                                            ->required()
                                            ->formatStateUsing(fn ($state, $livewire) => $livewire instanceof EditRecord
                                                ? SanitizationHelper::stripFormatting($state)
                                                : $state
                                            )
                                            ->dehydrateStateUsing(fn ($state) => $state)
                                            ->rules(fn ($livewire): array => $livewire instanceof ViewRecord ? [] : ['numeric']),
                                    ])->columns(),
                                Section::make()
                                    ->schema([
                                        Section::make()
                                            ->schema([
                                                Select::make('negotiable')
                                                    ->required()
                                                    ->default(false)
                                                    ->hint('Are the terms negotiable?')
                                                    ->options(PropertyNegotiable::class),
                                            ])->columnSpan(1),
                                        Section::make()
                                            ->schema([
                                                Select::make('location_id')
                                                    ->label('Location')
                                                    ->required()
                                                    ->searchable()
                                                    ->relationship('location', 'full_address')
                                                    ->preload(),
                                            ])->columnSpan(1),
                                    ])->columns(),
                            ])->columnSpan(2),
                        Group::make()
                            ->schema([
                                Section::make()
                                    ->schema([
                                        Select::make('available')
                                            ->required()
                                            ->label('Availability')
                                            ->options(PropertyAvailable::class)
                                            ->visible(fn ($livewire): bool => ! $livewire instanceof CreateRecord),
                                        MarkdownEditor::make('description')
                                            ->required(),
                                        FileUpload::make('property_image')
                                            ->image()
                                            ->disk('public')
                                            ->maxSize(self::$imageMaxSize)
                                            ->directory(self::$directoryPath)
                                            ->imagePreviewHeight(self::$imagePreviewHeight),
                                    ]),
                            ])->columnSpan(1),
                    ]),
            ]);
    }
}
