<?php

namespace App\Filament\ReusableResources\ResourceForm;

use Exception;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CustomerSupportForm
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
                        Section::make()
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->minLength(3),
                                TextInput::make('email')
                                    ->email()
                                    ->required(),
                                MarkdownEditor::make('message')
                                    ->required(),
                            ])->columnSpan(1),
                        Section::make()
                            ->schema([
                                TextInput::make('subject')
                                    ->required(),
                                TextInput::make('phone_number')
                                    ->tel()
                                    ->required()
                                    ->minLength(10)
                                    ->maxLength(12)
                                    ->label('Phone Number'),
                                MarkdownEditor::make('reply'),
                            ])->columnSpan(1),
                    ])->columns(),
            ]);
    }
}
