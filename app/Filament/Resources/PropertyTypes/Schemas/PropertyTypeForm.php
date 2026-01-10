<?php

namespace App\Filament\Resources\PropertyTypes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class PropertyTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Property Classification')
                    ->description('Define the categories used to organize property listings (e.g., Apartment, Villa, Commercial).')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                // Main Content (Left)
                                Group::make([
                                    Section::make('Core Details')
                                        ->icon(Heroicon::Tag)
                                        ->compact()
                                        ->schema([
                                            TextInput::make('type_name')
                                                ->label('Type Name')
                                                ->placeholder('e.g. Penthouse')
                                                ->required()
                                                ->maxLength(255)
                                                ->unique(ignoreRecord: true),
                                        ]),
                                ])->columnSpan(2),

                                // Sidebar (Right)
                                Group::make([
                                    Section::make('Audit Information')
                                        ->icon(Heroicon::Clock)
                                        ->compact()
                                        ->visible(fn ($livewire) => $livewire instanceof EditRecord)
                                        ->schema([
                                            DateTimePicker::make('created_at')
                                                ->label('Created On')
                                                ->disabled()
                                                ->dehydrated(false),

                                            DateTimePicker::make('updated_at')
                                                ->label('Last Modified')
                                                ->disabled()
                                                ->dehydrated(false),
                                        ]),
                                ])->columnSpan(1),
                            ]),
                    ]),
            ]);
    }
}
