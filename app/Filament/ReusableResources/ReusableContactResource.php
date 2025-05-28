<?php

namespace App\Filament\ReusableResources;

use App\Enums\ContactSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class ReusableContactResource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Section::make('')
                            ->schema([
                                Forms\Components\TextInput::make('label')
                                    ->required(),
                                Forms\Components\TextInput::make('icon')
                                    ->required(),
                            ])->columns(),
                        Forms\Components\Section::make('')
                            ->schema([
                                Forms\Components\TextInput::make('link')
                                    ->required(),
                                Forms\Components\TextInput::make('link_text')
                                    ->required()
                                    ->label('Link Text'),
                            ])->columns(),
                        Forms\Components\Section::make('')
                            ->schema([
                                Forms\Components\Select::make('section')
                                    ->native(false)
                                    ->default(ContactSection::ALL)
                                    ->options(ContactSection::class),
                            ]),
                    ]),
            ]);
    }

    public static function columns(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('icon')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('link')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('link_text')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('section')
                    ->badge()
                    ->sortable()
                    ->searchable(),
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
