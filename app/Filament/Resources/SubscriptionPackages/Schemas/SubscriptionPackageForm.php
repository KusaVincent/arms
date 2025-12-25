<?php

namespace App\Filament\Resources\SubscriptionPackages\Schemas;

use App\Enums\PackageStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SubscriptionPackageForm
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
