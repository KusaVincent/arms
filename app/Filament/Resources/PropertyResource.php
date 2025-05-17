<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Models\Location;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('rent')
                    ->required()
                    ->formatStateUsing(fn ($state, $livewire) =>
                        $livewire instanceof EditRecord
                            ? self::stripFormatting($state)
                            : $state
                    )
                    ->dehydrateStateUsing(fn ($state) => $state)
                    ->rules(fn ($livewire) => !$livewire instanceof ViewRecord ? ['numeric'] : []),
                Forms\Components\TextInput::make('deposit')
                    ->required()
                    ->formatStateUsing(fn ($state, $livewire) =>
                        $livewire instanceof EditRecord
                            ? self::stripFormatting($state)
                            : $state
                    )
                    ->dehydrateStateUsing(fn ($state) => $state)
                    ->rules(fn ($livewire) => !$livewire instanceof ViewRecord ? ['numeric'] : []),
                Forms\Components\Select::make('negotiable')
                    ->required()
                    ->options([
                        true => 'Yes',
                        false => 'No',
                    ])
                    ->default(false),
                Forms\Components\Select::make('available')
                    ->required()
                    ->options([
                        true => 'Yes',
                        false => 'No',
                    ])
                    ->visible(fn ($livewire) => $livewire instanceof EditRecord),
                Forms\Components\Select::make('location_id')
                    ->required()
                    ->searchable()
                    ->relationship('location', 'id')
                    ->getOptionLabelUsing(fn ($value) => optional(Location::find($value))->full_details)
                    ->getSearchResultsUsing(fn (string $search) => Location::query()
                        ->where('area', 'like', "%{$search}%")
                        ->orWhere('town_city', 'like', "%{$search}%")
                        ->orWhere('address', 'like', "%{$search}%")
                        ->get()
                        ->pluck('full_details', 'id')
                    )
                    ->options(function () {
                        return Location::all()->mapWithKeys(function ($location) {
                            return [
                                $location->id => implode(', ', array_filter([
                                    $location->town_city,
                                    $location->area,
                                    $location->address,
                                ])),
                            ];
                        })->toArray();
                    }),
                Forms\Components\Select::make('property_type_id')
                    ->required()
                    ->searchable()
                    ->relationship('propertyType', 'type_name'),
                Forms\Components\MarkdownEditor::make('description')
                    ->required(),
                Forms\Components\FileUpload::make('property_image')
                    ->image()
                    ->required()
                    ->maxSize(5120)
                    ->imagePreviewHeight('240')
                    ->directory('property/images/'),
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('propertyType.type_name')
                    ->searchable(),
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
                    ->formatStateUsing(fn ($state): string => intval($state) ? 'Yes' : 'No')
                    ->color(fn ($state): string => intval($state) ? 'success' : 'warning'),
                Tables\Columns\TextColumn::make('negotiable')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state): string => intval($state) ? 'Yes' : 'No')
                    ->color(fn ($state): string => intval($state) ? 'success' : 'warning'),
                Tables\Columns\TextColumn::make('location_summary')
                    ->label('Location')
                    ->getStateUsing(function ($record) {
                        $parts = [];
                        if ($record->location?->town_city) {
                            $parts[] = $record->location->town_city;
                        }
                        if ($record->location?->area) {
                            $parts[] = $record->location->area;
                        }
                        if ($record->location?->address) {
                            $parts[] = $record->location->address;
                        }
                        return empty($parts) ? null : implode(', ', $parts);
                    })
                    ->searchable(query: function (Builder $query, string $search) {
                        return $query
                            ->orWhereRelation('location', 'town_city', 'like', "%{$search}%")
                            ->orWhereRelation('location', 'area',     'like', "%{$search}%")
                            ->orWhereRelation('location', 'address',  'like', "%{$search}%");
                    }),
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
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }

    protected static function stripFormatting($value): float
    {
        if (is_string($value)) {
            return (float) str_replace(['Ksh ', ','], '', $value);
        }
        return $value;
    }
}
