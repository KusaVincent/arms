<?php

namespace App\Filament\Resources\Abouts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AboutForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('About Management')
                    ->description('Draft and manage the About section.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Group::make([
                                    Section::make('Main Content')
                                        ->icon('heroicon-m-pencil-square')
                                        ->compact()
                                        ->schema([
                                            TextInput::make('title')
                                                ->required()
                                                ->maxLength(255)
                                                ->placeholder('e.g., Our Mission'),

                                            MarkdownEditor::make('content')
                                                ->label('Body Content')
                                                ->required()
                                                ->columnSpanFull(),
                                        ]),
                                ])->columnSpan(2),

                                Group::make([
                                    Section::make('Audit Information')
                                        ->icon('heroicon-m-clock')
                                        ->compact()
                                        ->schema([
                                            DateTimePicker::make('created_at')
                                                ->label('Date Created')
                                                ->disabled()
                                                ->dehydrated(false)
                                                ->visible(fn ($livewire) => $livewire instanceof EditRecord),

                                            DateTimePicker::make('updated_at')
                                                ->label('Last Updated')
                                                ->disabled()
                                                ->dehydrated(false)
                                                ->visible(fn ($livewire) => $livewire instanceof EditRecord),
                                        ]),
                                ])->columnSpan(1),
                            ]),
                    ]),
            ]);
    }
}
