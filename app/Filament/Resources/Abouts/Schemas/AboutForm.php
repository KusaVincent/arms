<?php

namespace App\Filament\Resources\Abouts\Schemas;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AboutForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Main Content')
                    ->description('The primary information for the About section.')
                    ->schema([
                        TextInput::make('title')
                            ->required()->maxLength(255)
                            ->placeholder('e.g. Our Mission'),

                        MarkdownEditor::make('content')
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
