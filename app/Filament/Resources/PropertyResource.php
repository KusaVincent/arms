<?php

namespace App\Filament\Resources;

use App\Enums\PropertyAvailable;
use App\Enums\PropertyNegotiable;
use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers\AmenitiesRelationManager;
use App\Models\Property;
use App\Utils\LocationHelper;
use App\Utils\SanitizationHelper;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                                            ->disk('sftp')
                                            ->directory('images')
                                            ->visibility('public')
                                            ->imagePreviewHeight('240'),
                                    ]),
                            ])->columnSpan(1),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('property_image')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('propertyType.type_name')
                    ->searchable()
                    ->label('Property Type'),
                Tables\Columns\TextColumn::make('rent')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('deposit')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('available')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->label('Availability'),
                Tables\Columns\TextColumn::make('negotiable')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('location.location_summary')
                    ->limit(20)
                    ->label('Location')
                    ->toggleable(isToggledHiddenByDefault: true),
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
            AmenitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}
