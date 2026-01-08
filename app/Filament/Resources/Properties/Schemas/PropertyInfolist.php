<?php

namespace App\Filament\Resources\Properties\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;

class PropertyInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        // LEFT COLUMN: Core Property Details
                        Group::make([
                            Section::make('Property Overview')
                                ->icon('heroicon-m-home')
                                ->schema([
                                    TextEntry::make('name')
                                        ->label('Listing Title')
                                        ->size(TextSize::Large)
                                        ->weight(FontWeight::Bold),

                                    TextEntry::make('propertyType.type_name')
                                        ->label('Type')
                                        ->badge(),
                                ])->columns(2),

                            Section::make('Location & Description')
                                ->icon('heroicon-m-map-pin')
                                ->schema([
                                    TextEntry::make('location.full_address')
                                        ->label('Address')
                                        ->icon('heroicon-m-map-pin')
                                        ->color('primary')
                                        ->copyable(),

                                    TextEntry::make('description')
                                        ->markdown()
                                        ->prose()
                                        ->columnSpanFull(),
                                ]),

                            Section::make('Financials')
                                ->icon('heroicon-m-banknotes')
                                ->schema([
                                    TextEntry::make('rent')
                                        ->money('INR')
                                        ->color('success')
                                        ->weight(FontWeight::Bold),

                                    TextEntry::make('deposit')
                                        ->money('INR'),

                                    IconEntry::make('negotiable')
                                        ->boolean(),
                                ])->columns(3),
                        ])->columnSpan(2),

                        // RIGHT COLUMN: Status, Image & Audit
                        Group::make([
                            Section::make('Availability')
                                ->schema([
                                    TextEntry::make('available')
                                        ->hiddenLabel()
                                        ->badge()
                                        ->color(fn ($state) => match ($state?->value ?? $state) {
                                            'available', true => 'success',
                                            'rented', false => 'danger',
                                            default => 'gray',
                                        }),
                                ]),

                            Section::make('Featured Image')
                                ->schema([
                                    ImageEntry::make('property_image')
                                        ->hiddenLabel()
                                        ->extraImgAttributes([
                                            'class' => 'rounded-xl shadow-md w-full object-cover',
                                        ]),
                                ]),

                            // FIXED: Removed description() and used dateTime()
                            Section::make('Audit Trail')
                                ->icon('heroicon-m-finger-print')
                                ->schema([
                                    TextEntry::make('created_at')
                                        ->label('Created On')
                                        ->dateTime('M j, Y H:i'),

                                    TextEntry::make('created_diff') // Virtual entry for relative time
                                    ->label('Created')
                                        ->state(fn ($record) => $record->created_at?->diffForHumans())
                                        ->color('gray')
                                        ->size(TextSize::Small),

                                    TextEntry::make('updated_at')
                                        ->label('Last Updated')
                                        ->dateTime('M j, Y H:i')
                                        ->color('gray'),
                                ]),
                        ])->columnSpan(1),
                    ])->columnSpanFull(),
            ]);
    }
}
