<?php

namespace App\Filament\Resources\ServiceAvailabilities\Schemas;

use App\Enums\ActiveServiceAvailability;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
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
                                ->description('This unique key is utilized by the system logic to verify availability.')
                                ->schema([
                                    TextInput::make('service_key')
                                        ->label('Service Key')
                                        ->placeholder('e.g., email_service')
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->helperText('Warning: Changing this may affect system integrations.')
                                        ->disabledOn('edit'),
                                ]),
                        ])->columnSpan(2),

                        Group::make([
                            Section::make('Status')
                                ->schema([
                                    Select::make('is_active')
                                        ->label('Service Availability')
                                        ->options(ActiveServiceAvailability::class)
                                        ->default(ActiveServiceAvailability::NO)
                                        ->native(false)
                                        ->prefixIcon('heroicon-m-bolt')
                                        ->required(),
                                ]),

                            Section::make('Record History')
                                ->schema([
                                    TextInput::make('created_at')
                                        ->label('Date Registered')
                                        ->disabled()
                                        ->visibleOn('edit'),
                                    TextInput::make('updated_at')
                                        ->label('Last Sync')
                                        ->disabled()
                                        ->visibleOn('edit'),
                                ]),
                        ])->columnSpan(1),
                    ])->columnSpanFull(),
            ]);
    }
}
