<?php

namespace App\Filament\Resources\PackageSubscriptions\Schemas;

use App\Enums\PackageStatus;
use App\Utils\SanitizationHelper;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;

class PackageSubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('no_of_properties')
                    ->required()
                    ->numeric(),
                TextInput::make('no_of_support_team')
                    ->required()
                    ->numeric(),
                TextInput::make('package_price')
                    ->required()
                    ->formatStateUsing(fn ($state, $livewire) => $livewire instanceof EditRecord
                        ? SanitizationHelper::stripFormatting($state)
                        : $state
                    ),
                TextInput::make('negotiated_price')
                    ->required()
                    ->formatStateUsing(fn ($state, $livewire) => $livewire instanceof EditRecord
                        ? SanitizationHelper::stripFormatting($state)
                        : $state
                    ),
                Select::make('status')
                    ->options(PackageStatus::class)
                    ->required(),
                DateTimePicker::make('effective_date')
                    ->required(),
                DateTimePicker::make('expiry_date')
                    ->required(),
            ]);
    }
}
