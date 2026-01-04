<?php

namespace App\Filament\Resources\CustomerSupports\Schemas;

use Exception;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CustomerSupportForm
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
                        Section::make()
                            ->schema([
                                TextInput::make('name')
                                    ->readOnly()
                                    ->copyable(),
                                TextInput::make('email')
                                    ->readOnly()
                                    ->copyable(),
                                TextInput::make('phone_number')
                                    ->readOnly()
                                    ->copyable(),
                            ])->columns(3),
                        Section::make()
                            ->schema([
                                TextEntry::make('subject')
                                    ->copyable(),
                                TextEntry::make('message')
                                    ->copyable(),
                            ])->columns(1),
                        Section::make()
                            ->schema([
                                MarkdownEditor::make('reply')
                                    ->required(),
                            ])->columns(1),
                    ])->columns(),
            ]);
    }
}
