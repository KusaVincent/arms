<?php

namespace App\Filament\Resources\Amenities\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class AmenityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Amenity Management')
                    ->description('Define property features using Tailwind color utility classes.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Group::make([
                                    Section::make('Amenity Details')
                                        ->icon(Heroicon::InformationCircle)
                                        ->compact()
                                        ->schema([
                                            Grid::make(2)
                                                ->schema([
                                                    TextInput::make('amenity_name')
                                                        ->required(),

                                                    TextInput::make('amenity_icon')
                                                        ->label('Heroicon Name')
                                                        ->placeholder('heroicon-o-wifi')
                                                        ->required(),

                                                    TextInput::make('amenity_icon_color')
                                                        ->label('Tailwind Color Class')
                                                        ->placeholder('text-blue-500')
                                                        ->required()
                                                        ->helperText('Use format: text-{color}-{weight}'),
                                                ]),

                                            MarkdownEditor::make('amenity_description')
                                                ->required()
                                                ->columnSpanFull(),
                                        ]),
                                ])->columnSpan(2),

                                Group::make([
                                    Section::make('Audit Trail')
                                        ->icon(Heroicon::Clock)
                                        ->compact()
                                        ->visible(fn ($livewire) => $livewire instanceof EditRecord)
                                        ->schema([
                                            DateTimePicker::make('created_at')->disabled(),
                                            DateTimePicker::make('updated_at')->disabled(),
                                        ]),
                                ])->columnSpan(1),
                            ]),
                    ]),
            ]);
    }
}
