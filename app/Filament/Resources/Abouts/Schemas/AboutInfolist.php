<?php

namespace App\Filament\Resources\Abouts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize; // Import the correct Enum for v4

class AboutInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        Group::make([
                            Section::make('Article Details')
                                ->schema([
                                    TextEntry::make('title')
                                        ->weight('bold')
                                        ->size(TextSize::Large),

                                    TextEntry::make('content')
                                        ->markdown()
                                        ->prose(),
                                ]),
                        ])->columnSpan(2),

                        Group::make([
                            Section::make('System Metadata')
                                ->schema([
                                    TextEntry::make('created_at')
                                        ->label('Date Created')
                                        ->dateTime()
                                        ->icon('heroicon-o-calendar')
                                        ->color('gray'),

                                    TextEntry::make('updated_at')
                                        ->label('Last Modified')
                                        ->since()
                                        ->color('primary')
                                        ->icon('heroicon-o-arrow-path'),
                                ]),
                        ])->columnSpan(1),
                    ])->columnSpanFull(),
            ]);
    }
}
