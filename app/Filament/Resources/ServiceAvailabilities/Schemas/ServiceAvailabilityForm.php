<?php

namespace App\Filament\Resources\ServiceAvailabilities\Schemas;

use App\Enums\ActiveServiceAvailability;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceAvailabilityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Service Management')
                    ->description('Configuration and availability settings for system services.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Group::make([
                                    Section::make('General Information')
                                        ->icon('heroicon-m-information-circle')
                                        ->schema([
                                            TextInput::make('service_name')
                                                ->label('Service Display Name')
                                                ->placeholder('e.g., Email Notifications')
                                                ->required()
                                                ->maxLength(255),
                                        ]),

                                    Section::make('Technical Configuration')
                                        ->icon('heroicon-m-cpu-chip')
                                        ->description('Unique key used by system logic.')
                                        ->schema([
                                            TextInput::make('service_key')
                                                ->label('Service Key')
                                                ->placeholder('e.g., email_service')
                                                ->required()
                                                ->unique(ignoreRecord: true)
                                                ->disabledOn('edit'),
                                        ]),
                                ])->columnSpan(2),

                                Group::make([
                                    Section::make('Status')
                                        ->icon('heroicon-m-check-badge')
                                        ->schema([
                                            Select::make('is_active')
                                                ->label('Availability Status')
                                                ->options(ActiveServiceAvailability::class)
                                                ->default(ActiveServiceAvailability::NO)
                                                ->native(false)
                                                ->prefixIcon('heroicon-m-bolt')
                                                ->required(),
                                        ]),

                                    Section::make('Audit Information')
                                        ->icon('heroicon-m-clock')
                                        ->schema([
                                            DateTimePicker::make('created_at')
                                                ->label('Date Registered')
                                                ->disabled()
                                                ->dehydrated(false)
                                                ->visible(fn ($livewire) => $livewire instanceof EditRecord),

                                            DateTimePicker::make('updated_at')
                                                ->label('Last Updated')
                                                ->disabled()
                                                ->dehydrated(false)
                                                ->visible(fn ($livewire) => $livewire instanceof EditRecord),
                                        ]),
                                ])->columnSpan(1),
                            ]),
                    ])
                    ->collapsible(),
            ]);
    }
}
