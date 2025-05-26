<?php

namespace App\Filament\ReusableResources;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReusablePropertyResource
{
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
