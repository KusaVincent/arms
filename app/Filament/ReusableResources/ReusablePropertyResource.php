<?php

namespace App\Filament\ReusableResources;

use App\Enums\PropertyAvailable;
use App\Enums\PropertyNegotiable;
use App\Utils\LocationHelper;
use App\Utils\SanitizationHelper;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReusablePropertyResource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required(),
                                        Forms\Components\Select::make('property_type_id')
                                            ->required()
                                            ->searchable()
                                            ->label('Property Type')
                                            ->relationship('propertyType', 'type_name'),
                                    ])->columns(),
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('rent')
                                            ->required()
                                            ->formatStateUsing(fn ($state, $livewire) => $livewire instanceof EditRecord
                                                ? SanitizationHelper::stripFormatting($state)
                                                : $state
                                            )
                                            ->dehydrateStateUsing(fn ($state) => $state)
                                            ->rules(fn ($livewire): array => $livewire instanceof ViewRecord ? [] : ['numeric']),
                                        Forms\Components\TextInput::make('deposit')
                                            ->required()
                                            ->formatStateUsing(fn ($state, $livewire) => $livewire instanceof EditRecord
                                                ? SanitizationHelper::stripFormatting($state)
                                                : $state
                                            )
                                            ->dehydrateStateUsing(fn ($state) => $state)
                                            ->rules(fn ($livewire): array => $livewire instanceof ViewRecord ? [] : ['numeric']),
                                    ])->columns(),
                                Forms\Components\Section::make()
                                    ->schema([Forms\Components\Section::make()
                                        ->description('Is rent negotiable or fixed?')
                                        ->schema([
                                            Forms\Components\Select::make('negotiable')
                                                ->required()
                                                ->options(PropertyNegotiable::class)
                                                ->default(false),
                                        ])->columnSpan(1),
                                        Forms\Components\Section::make()
                                            ->schema([
                                                Forms\Components\Select::make('location_id')
                                                    ->required()
                                                    ->searchable()
                                                    ->relationship('location', 'id')
                                                    ->getOptionLabelUsing(fn ($value): ?string => LocationHelper::getFullDetails($value))
                                                    ->getSearchResultsUsing(fn (string $search): array => LocationHelper::getSearchResults($search))
                                                    ->options(fn (): array => LocationHelper::getOptions()),
                                            ])->columnSpan(1),
                                    ])->columns(),
                            ])->columnSpan(2),
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make()
                                    ->schema([
                                        Forms\Components\Select::make('available')
                                            ->required()
                                            ->label('Availability')
                                            ->options(PropertyAvailable::class)
                                            ->visible(fn ($livewire): bool => ! $livewire instanceof CreateRecord),
                                        Forms\Components\MarkdownEditor::make('description')
                                            ->required(),
                                        Forms\Components\FileUpload::make('property_image')
                                            ->image()
                                            ->required()
                                            ->maxSize(5120)
                                            ->directory('images')
                                            ->visibility('public')
                                            ->imagePreviewHeight('240'),
                                    ]),
                            ])->columnSpan(1),
                    ])->columns(3),
            ]);
    }

    public static function columns(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('property_image')
                    ->label('Image'),
                TextColumn::make('propertyType.type_name')
                    ->searchable()
                    ->label('Property Type'),
                TextColumn::make('rent')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('deposit')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('available')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->label('Availability'),
                TextColumn::make('negotiable')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('location.location_summary')
                    ->limit(20)
                    ->label('Location')
                    ->toggleable(isToggledHiddenByDefault: true),
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
