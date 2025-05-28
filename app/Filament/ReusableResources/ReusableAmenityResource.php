<?php

namespace App\Filament\ReusableResources;

use App\Utils\SanitizationHelper;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables;
use Filament\Tables\Table;

class ReusableAmenityResource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Section::make('')
                            ->schema([
                                Forms\Components\TextInput::make('amenity_name')
                                    ->required()
                                    ->label('Name'),
                                Forms\Components\TextInput::make('amenity_icon')
                                    ->required()
                                    ->label('Icon'),
                                Forms\Components\TextInput::make('amenity_icon_color')
                                    ->required()
                                    ->label('Color'),
                            ])->columnSpan(3)->columns(3),
                        Forms\Components\Section::make('')
                            ->schema([
                                Forms\Components\MarkdownEditor::make('amenity_description')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Description'),
                            ])->columnSpan(3),
                    ]),
            ]);
    }

    public static function columns(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('amenity_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('amenity_icon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amenity_icon_color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amenity_description')
                    ->searchable()
                    ->limit(15),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Added On')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Date Updated')
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
