<?php

namespace App\Filament\Resources\Amenities\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Filament\Support\Icons\Heroicon;

class AmenityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Amenity Preview')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Group::make([
                                    Section::make('Core Information')
                                        ->icon(Heroicon::InformationCircle)
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('amenity_name')
                                                ->label('Name')
                                                ->weight(FontWeight::Bold)
                                                ->size(TextSize::Large),

                                            TextEntry::make('amenity_icon')
                                                ->label('Visual Preview')
                                                ->formatStateUsing(fn ($record) => "Class: {$record->amenity_icon_color}")
                                                ->extraAttributes(fn ($record) => [
                                                    'class' => $record->amenity_icon_color,
                                                ]),

                                            TextEntry::make('amenity_description')
                                                ->label('Scope of Amenity')
                                                ->markdown()
                                                ->columnSpanFull(),
                                        ])->columns(2),
                                ])->columnSpan(2),

                                Group::make([
                                    Section::make('Metadata')
                                        ->icon(Heroicon::FingerPrint)
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('created_at')->dateTime(),
                                            TextEntry::make('updated_at')->since()->size(TextSize::Small),
                                        ]),
                                ])->columnSpan(1),
                            ]),
                    ]),
            ]);
    }
}
