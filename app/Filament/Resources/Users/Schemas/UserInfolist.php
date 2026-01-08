<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        Group::make([
                            Section::make('Account Overview')
                                ->schema([
                                    TextEntry::make('full_name')
                                    ->label('Name')
                                        ->getStateUsing(fn ($record) => "{$record->first_name} {$record->middle_name} {$record->last_name}")
                                        ->weight(FontWeight::Bold)
                                        ->size(TextSize::Large),

                                    Grid::make(2)
                                        ->schema([
                                            TextEntry::make('email')
                                                ->icon('heroicon-m-envelope')
                                                ->copyable(),
                                            TextEntry::make('phone_number')
                                                ->icon('heroicon-m-phone')
                                                ->copyable(),
                                        ]),
                                ]),
                        ])->columnSpan(2),

                        Group::make([
                            Section::make('Permissions')
                                ->schema([
                                    TextEntry::make('roles.name')
                                        ->label('Assigned Roles')
                                        ->badge()
                                        ->color('primary')
                                        ->formatStateUsing(fn ($state) => ucwords(str_replace('_', ' ', $state))),
                                ]),

                            Section::make('Account History')
                                ->schema([
                                    TextEntry::make('created_at')
                                        ->label('Member Since')
                                        ->date(),
                                    TextEntry::make('updated_at')
                                        ->label('Last Activity')
                                        ->since(),
                                ]),
                        ])->columnSpan(1),
                    ])->columnSpanFull(),
            ]);
    }
}
