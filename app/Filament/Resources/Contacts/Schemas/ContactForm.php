<?php

namespace App\Filament\Resources\Contacts\Schemas;

use App\Enums\ContactSection;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        Group::make([
                            Section::make('Contact Identity')
                                ->description('Define the label and icon for this contact method.')
                                ->schema([
                                    TextInput::make('label')
                                        ->required()
                                        ->placeholder('e.g. WhatsApp Support'),
                                    TextInput::make('icon')
                                        ->required()
                                        ->placeholder('heroicon-o-chat-bubble-left'),
                                ])->columns(2),

                            Section::make('Call to Action')
                                ->schema([
                                    TextInput::make('link')
                                        ->required()
                                        ->url(),
                                    TextInput::make('link_text')
                                        ->label('Display Text')
                                        ->required(),
                                ])->columns(2),
                        ])->columnSpan(2),

                        Group::make([
                            Section::make('Classification')
                                ->schema([
                                    Select::make('section')
                                        ->native(false)
                                        ->default(ContactSection::ALL)
                                        ->options(ContactSection::class)
                                        ->prefixIcon('heroicon-m-tag'),
                                ]),
                        ])->columnSpan(1),
                    ])->columnSpanFull(),
            ]);
    }
}
