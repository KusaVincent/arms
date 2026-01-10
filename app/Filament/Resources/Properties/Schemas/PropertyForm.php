<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Enums\PropertyAvailable;
use App\Enums\PropertyNegotiable;
use App\Filament\ReusableResources\Common\MoneyField;
use App\Filament\ReusableResources\Common\SelectField;
use App\Support\SanitizationHelper;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class PropertyForm
{
    protected static int $imageMaxSize = 5120;
    protected static string $imagePreviewHeight = '250';
    protected static string $directoryPath = 'property/images';

    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(3)
                ->schema([

                    Group::make([
                        Section::make('Core Details')
                            ->icon('heroicon-m-home')
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
                            ->icon('heroicon-m-currency-rupee')
                            ->schema([
                                MoneyField::make('rent')
                                    ->rules(['numeric'])
                                    ->dehydrateStateUsing(fn ($state) => $state),
                                MoneyField::make('deposit')
                                    ->rules(['numeric'])
                                    ->dehydrateStateUsing(fn ($state) => $state),

                                SelectField::make('negotiable')
                                    ->label('Terms Negotiable')
                                    ->options(PropertyNegotiable::class)
                                    ->default(false),
                            ])->columns(3),
                    ])->columnSpan(2),

                    Group::make([
                        Section::make('Status & Visibility')
                            ->schema([
                                SelectField::make('available')
                                    ->label('Availability Status')
                                    ->options(PropertyAvailable::class)
                                    ->visible(fn ($livewire) => ! $livewire instanceof CreateRecord),
                            ]),

                        Section::make('Property Image')
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
                            ->visible(fn ($livewire) => ! $livewire instanceof CreateRecord)
                            ->schema([
                                TextInput::make('created_at')
                                    ->label('Listing Created')
                                    ->afterStateHydrated(fn ($state, $set, $record) => $set('created_at', $record?->created_at?->diffForHumans() ?? '-'))
                                    ->disabled()
                                    ->dehydrated(false),

                                TextInput::make('updated_at')
                                    ->label('Last Modified')
                                    ->afterStateHydrated(fn ($state, $set, $record) => $set('updated_at', $record?->updated_at?->format('M j, Y H:i') ?? '-'))
                                    ->disabled()
                                    ->dehydrated(false),
                            ]),
                    ])->columnSpan(1),
                ])->columnSpanFull(),
        ]);
    }
}
