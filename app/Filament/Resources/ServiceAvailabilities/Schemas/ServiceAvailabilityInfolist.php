<?php

namespace App\Filament\Resources\ServiceAvailabilities\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;

class ServiceAvailabilityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Service Availability Overview')
                    ->description('Detailed configuration and status of the system service.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Group::make([
                                    Section::make('Service Details')
                                        ->icon('heroicon-m-information-circle')
                                        ->schema([
                                            TextEntry::make('service_name')
                                                ->label('Display Name')
                                                ->weight(FontWeight::Bold)
                                                ->size(TextSize::Large)
                                                ->copyable(),

                                            TextEntry::make('service_key')
                                                ->label('System Key')
                                                ->fontFamily('mono')
                                                ->icon('heroicon-m-code-bracket')
                                                ->color('primary')
                                                ->copyable(),
                                        ])->columns(2),
                                ])->columnSpan(2),

                                Group::make([
                                    Section::make('Current State')
                                        ->icon('heroicon-m-signal')
                                        ->schema([
                                            TextEntry::make('is_active')
                                                ->label('Availability Status')
                                                ->badge(),
                                        ]),

                                    Section::make('Audit Information')
                                        ->icon('heroicon-m-clock')
                                        ->schema([
                                            TextEntry::make('created_at')
                                                ->label('Date Registered')
                                                ->dateTime(),

                                            TextEntry::make('updated_at')
                                                ->label('Last Modified')
                                                ->dateTime(),
                                        ]),
                                ])->columnSpan(1),
                            ]),
                    ]),
            ]);
    }
}
