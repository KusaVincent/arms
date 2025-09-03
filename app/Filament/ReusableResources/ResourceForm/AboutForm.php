<?php

namespace App\Filament\ReusableResources\ResourceForm;

use Exception;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AboutForm
{
    /**
     * @throws Exception
     */
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('title')
                            ->required(),
                        MarkdownEditor::make('content')
                            ->required()
                            ->maxLength(255),
                    ]),
            ]);
    }
}
