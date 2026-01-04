<?php

namespace App\Filament\Resources\Contacts\Schemas;

use App\Enums\ContactSection;
use Exception;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactForm
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
                                TextInput::make('label')
                                    ->required(),
                                TextInput::make('icon')
                                    ->required(),
                            ])->columns(),
                        Section::make('')
                            ->schema([
                                TextInput::make('link')
                                    ->required(),
                                TextInput::make('link_text')
                                    ->required()
                                    ->label('Link Text'),
                            ])->columns(),
                        Section::make('')
                            ->schema([
                                Select::make('section')
                                    ->native(false)
                                    ->default(ContactSection::ALL)
                                    ->options(ContactSection::class),
                            ]),
                    ]),
            ]);
    }
}
