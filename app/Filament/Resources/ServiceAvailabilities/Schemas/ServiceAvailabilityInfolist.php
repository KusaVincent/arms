<?php

namespace App\Filament\Resources\ServiceAvailabilities\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class ServiceAvailabilityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        Group::make([
                            Section::make('Service Details')
                                ->schema([
                                    TextEntry::make('service_name')
                                        ->label('Display Name')
                                        ->weight(FontWeight::Bold)
                                        ->copyable(),

                                    TextEntry::make('service_key')
                                        ->label('System Key')
                                        ->fontFamily('mono')
                                        ->icon('heroicon-m-code-bracket')
                                        ->copyable(),
                                ])->columns(2),
                        ])->columnSpan(2),

                        Group::make([
                            Section::make('Current State')
                                ->schema([
                                    TextEntry::make('is_active')
                                        ->label('Availability Status')
                                        ->badge()
                                        ->color(fn ($state): string => match ($state) {
                                            'active', 'yes', '1' => 'success',
                                            default => 'danger',
                                        }),

                                    TextEntry::make('created_at')
                                        ->dateTime(),

                                    TextEntry::make('updated_at')
                                        ->label('Last Checked')
                                        ->since(),
                                ]),
                        ])->columnSpan(1),
                    ])->columnSpanFull(),
            ]);
    }
}
