<?php

namespace App\Filament\Resources\Amenities\Schemas;

use Exception;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AmenityForm
{
    /**
     * @throws Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Section::make('')
                            ->schema([
                                TextInput::make('amenity_name')
                                    ->required()
                                    ->label('Name'),
                                TextInput::make('amenity_icon')
                                    ->required()
                                    ->label('Icon'),
                                TextInput::make('amenity_icon_color')
                                    ->required()
                                    ->label('Color'),
                            ])->columnSpan(3)->columns(3),
                        Section::make('')
                            ->schema([
                                MarkdownEditor::make('amenity_description')
                                    ->required()
                                    ->maxLength(255)
                                    ->label('Description'),
                            ])->columnSpan(3),
                    ]),
            ]);
    }
}
