<?php

namespace App\Filament\Resources\PropertyTypes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Filament\Support\Icons\Heroicon;

class PropertyTypeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Classification Details')
                    ->description('Overview of the property category and system audit data.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Group::make([
                                    Section::make('Category Information')
                                        ->icon(Heroicon::Tag)
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('type_name')
                                                ->label('Classification Name')
                                                ->size(TextSize::Large)
                                                ->weight(FontWeight::Bold)
                                                ->badge()
                                                ->color('primary'),
                                        ]),
                                ])->columnSpan(2),

                                Group::make([
                                    Section::make('Audit Trail')
                                        ->icon(Heroicon::FingerPrint)
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('created_at')
                                                ->label('System Entry')
                                                ->dateTime('M j, Y H:i'),

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
