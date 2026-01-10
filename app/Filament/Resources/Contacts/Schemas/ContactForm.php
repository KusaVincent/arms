<?php

namespace App\Filament\Resources\Contacts\Schemas;

use App\Enums\ContactSection;
use BladeUI\Icons\Factory;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\View;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contact Configuration')
                    ->description('Manage public-facing links and their placement in the application.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Group::make([
                                    Section::make('General Information')
                                        ->icon('heroicon-m-identification')
                                        ->compact()
                                        ->schema([
                                            TextInput::make('label')
                                                ->label('Reference Label')
                                                ->required()
                                                ->placeholder('e.g., WhatsApp Support')
                                                ->maxLength(255),

                                            Grid::make(2)->schema([
                                                TextInput::make('link')
                                                    ->label('Destination URL')
                                                    ->required()
                                                    ->url()
                                                    ->suffixIcon('heroicon-m-link'),

                                                TextInput::make('link_text')
                                                    ->label('Display Text')
                                                    ->required()
                                                    ->placeholder('e.g., Chat with us'),
                                            ]),
                                        ]),
                                ])->columnSpan(2),

                                Group::make([
                                    Section::make('Placement & Branding')
                                        ->icon('heroicon-m-tag')
                                        ->compact()
                                        ->schema([
                                            Select::make('section')
                                                ->label('App Section')
                                                ->native(false)
                                                ->default(ContactSection::ALL)
                                                ->options(ContactSection::class)
                                                ->prefixIcon('heroicon-m-squares-2x2')
                                                ->required(),

                                            TextInput::make('icon')
                                                ->label('Heroicon Name')
                                                ->required()
                                                ->placeholder('e.g., phone')
                                                ->hint('Use name without prefix')
                                                ->suffixIcon(function ($state) {
                                                    if (! $state) {
                                                        return 'heroicon-m-question-mark-circle';
                                                    }

                                                    $icon = "heroicon-m-{$state}";

                                                    if (View::exists("filament-support::components.icons.{$icon}")) {
                                                        return $icon;
                                                    }

                                                    try {
                                                        app(Factory::class)->svg($icon);
                                                        return $icon;
                                                    } catch (\Exception $e) {
                                                        return 'heroicon-m-question-mark-circle';
                                                    }
                                                })
                                                ->live(onBlur: true),
                                        ]),

                                    Section::make('Audit Information')
                                        ->icon('heroicon-m-clock')
                                        ->compact()
                                        ->schema([
                                            DateTimePicker::make('created_at')
                                                ->label('Registered')
                                                ->disabled()
                                                ->dehydrated(false)
                                                ->visible(fn ($livewire) => $livewire instanceof EditRecord),

                                            DateTimePicker::make('updated_at')
                                                ->label('Last Modified')
                                                ->disabled()
                                                ->dehydrated(false)
                                                ->visible(fn ($livewire) => $livewire instanceof EditRecord),
                                        ]),
                                ])->columnSpan(1),
                            ]),
                    ]),
            ]);
    }
}
