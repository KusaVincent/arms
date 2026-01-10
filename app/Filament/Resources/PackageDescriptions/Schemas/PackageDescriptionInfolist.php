<?php

namespace App\Filament\Resources\PackageDescriptions\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;

class PackageDescriptionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Package Information')
                ->schema([
                    TextEntry::make('name')
                        ->weight('bold')
                        ->size('lg'),

                    Grid::make(3)->schema([
                        TextEntry::make('monthly_package_price')
                            ->label('Monthly Price'),

                        TextEntry::make('annual_package_price')
                            ->label('Annual Price'),

                        TextEntry::make('status')
                            ->badge(),
                    ]),

                    TextEntry::make('description')
                        ->markdown()
                        ->columnSpanFull(),
                ]),

            Section::make('Audit Log')
                ->description('System generated timestamps for this record.')
                ->columns(2)
                ->schema([
                    TextEntry::make('created_at')
                        ->label('Created On')
                        ->dateTime(),
                    TextEntry::make('updated_at')
                        ->label('Last Modified')
                        ->dateTime(),
                ])
        ]);
    }
}
