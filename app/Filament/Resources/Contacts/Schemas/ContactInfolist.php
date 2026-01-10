<?php

namespace App\Filament\Resources\Contacts\Schemas;

use BladeUI\Icons\Factory;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;

class ContactInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contact Management')
                    ->description('Configuration for public-facing contact links and social icons.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Group::make([
                                    Section::make('General Details')
                                        ->icon('heroicon-m-identification')
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('label')
                                                ->label('Reference Label')
                                                ->weight(FontWeight::Bold)
                                                ->size(TextSize::Large),

                                            Grid::make(2)->schema([
                                                TextEntry::make('link')
                                                    ->label('Destination URL')
                                                    ->icon('heroicon-m-link')
                                                    ->color('primary')
                                                    ->url(fn ($record) => $record->link, true)
                                                    ->limit(30),

                                                TextEntry::make('link_text')
                                                    ->label('Display Text')
                                                    ->badge()
                                                    ->color('gray'),
                                            ]),
                                        ]),
                                ])->columnSpan(2),

                                Group::make([
                                    Section::make('Configuration')
                                        ->icon('heroicon-m-cog')
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('section')
                                                ->label('App Section')
                                                ->badge()
                                                ->color('info'),

                                            TextEntry::make('icon')
                                                ->icon(function (?string $state) {
                                                    if (! $state) return 'heroicon-m-question-mark-circle';

                                                    $icon = "heroicon-m-{$state}";

                                                    if (view()->exists("filament-support::components.icons.{$icon}")) {
                                                        return $icon;
                                                    }

                                                    try {
                                                        app(Factory::class)->svg($icon);
                                                        return $icon;
                                                    } catch (\Exception $e) {
                                                        return 'heroicon-m-question-mark-circle';
                                                    }
                                                })
                                                ->tooltip(fn ($state) => "Icon key: {$state}")
                                                ->copyable()
                                                ->fontFamily('mono'),
                                        ]),

                                    Section::make('Metadata')
                                        ->icon('heroicon-m-clock')
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('created_at')
                                                ->label('Registered')
                                                ->dateTime()
                                                ->size(TextSize::ExtraSmall),

                                            TextEntry::make('updated_at')
                                                ->label('Modified')
                                                ->since()
                                                ->size(TextSize::ExtraSmall),
                                        ]),
                                ])->columnSpan(1),
                            ]),
                    ]),
            ]);
    }
}
