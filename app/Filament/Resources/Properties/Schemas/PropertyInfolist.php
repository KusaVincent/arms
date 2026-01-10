<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Filament\ReusableResources\Common\FilamentHelper;
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
                Section::make('Property Details')
                    ->description('Comprehensive view of the property listing, financial terms, and current status.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Group::make([
                                    Section::make('Property Overview')
                                        ->icon('heroicon-m-home')
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('name')
                                                ->label('Listing Title')
                                                ->size(TextSize::Large)
                                                ->weight(FontWeight::Bold),

                                            TextEntry::make('propertyType.type_name')
                                                ->label('Property Type')
                                                ->badge(),
                                        ])->columns(2),

                                    Section::make('Location & Description')
                                        ->icon('heroicon-m-map-pin')
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('location.full_address')
                                                ->label('Physical Address')
                                                ->icon('heroicon-m-map-pin')
                                                ->color('primary')
                                                ->copyable(),

                                            TextEntry::make('description')
                                                ->label('Property Narrative')
                                                ->markdown()
                                                ->prose()
                                                ->columnSpanFull(),
                                        ]),

                                    Section::make('Financials')
                                        ->icon('heroicon-m-banknotes')
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('rent')
                                                ->money('INR')
                                                ->color('success')
                                                ->weight(FontWeight::Bold),

                                            TextEntry::make('deposit')
                                                ->money('INR'),

                                            IconEntry::make('negotiable')
                                                ->label('Negotiable')
                                                ->boolean(),
                                        ])->columns(3),
                                ])->columnSpan(2),

                                Group::make([
                                    Section::make('Availability Status')
                                        ->icon('heroicon-m-check-circle')
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('available')
                                                ->hiddenLabel()
                                                ->badge(),
                                        ]),

                                    Section::make('Featured Image')
                                        ->icon('heroicon-m-photo')
                                        ->compact()
                                        ->schema([
                                            FilamentHelper::getGalleryImage('property_image', 'Property Image'),
                                        ]),

                                    Section::make('Audit Trail')
                                        ->icon('heroicon-m-finger-print')
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('created_at')
                                                ->label('Listed On')
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
