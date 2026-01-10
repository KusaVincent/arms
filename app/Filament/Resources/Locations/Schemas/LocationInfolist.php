<?php

namespace App\Filament\Resources\Locations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Filament\Support\Icons\Heroicon;

class LocationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Location Intelligence')
                    ->description('Verified physical address details and digital mapping coordinates.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Group::make([
                                    Section::make('Physical Address')
                                        ->icon(Heroicon::MapPin)
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('town_city')
                                                ->label('Town / City')
                                                ->weight(FontWeight::Bold)
                                                ->size(TextSize::Large),

                                            TextEntry::make('area')
                                                ->label('Area / Neighborhood')
                                                ->color('primary'),

                                            TextEntry::make('address')
                                                ->label('Street Address')
                                                ->columnSpanFull()
                                                ->prose()
                                                ->icon(Heroicon::HomeModern),
                                        ])->columns(2),
                                ])->columnSpan(2),

                                Group::make([
                                    Section::make('Digital Mapping')
                                        ->icon(Heroicon::GlobeAlt)
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('map')
                                                ->label('Navigation Link')
                                                ->state('Open in Maps') // Displays friendly text
                                                ->icon(Heroicon::ArrowTopRightOnSquare)
                                                ->color('primary')
                                                ->weight(FontWeight::Bold)
                                                // Clicking the text opens the link
                                                ->url(fn ($record) => $record->map, true)
                                                // This adds the native copy button to the entry safely
                                                ->copyable()
                                                ->copyMessage('Map URL copied to clipboard')
                                                ->copyMessageDuration(1500),
                                        ]),

                                    Section::make('Audit Trail')
                                        ->icon(Heroicon::FingerPrint)
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('created_at')
                                                ->label('Entry Created')
                                                ->dateTime('M j, Y'),

                                            TextEntry::make('updated_at')
                                                ->label('Last Activity')
                                                ->since()
                                                ->color('gray')
                                                ->size(TextSize::Small),
                                        ]),
                                ])->columnSpan(1),
                            ]),
                    ]),
            ]);
    }
}
