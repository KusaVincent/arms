<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;

class ContactInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        Group::make([
                            Section::make('Contact Overview')
                                ->schema([
                                    TextEntry::make('label')
                                        ->weight(FontWeight::Bold)
                                        ->size(TextSize::Large),

                                    TextEntry::make('link')
                                        ->label('Destination URL')
                                        ->icon('heroicon-m-arrow-top-right-on-square')
                                        ->color('primary')
                                        ->url(fn ($record) => $record->link, true),

                                    TextEntry::make('link_text')
                                        ->label('Button Label')
                                        ->badge()
                                        ->color('gray'),

                                    TextEntry::make('icon')
                                        ->copyable()
                                        ->fontFamily('mono'),
                                ])->columns(2),
                        ])->columnSpan(2),

                        Group::make([
                            Section::make('Attributes')
                                ->schema([
                                    TextEntry::make('section')
                                        ->badge()
                                        ->color('info'),

                                    TextEntry::make('created_at')
                                        ->dateTime(),

                                    TextEntry::make('updated_at')
                                        ->label('Last Modified')
                                        ->since(),
                                ]),
                        ])->columnSpan(1),
                    ])->columnSpanFull(),
            ]);
    }
}
