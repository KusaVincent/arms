<?php

namespace App\Filament\Resources\PackageSubscriptions\Schemas;

use App\Enums\PackageStatus;
use App\Filament\ReusableResources\Common\MoneyField;
use App\Filament\ReusableResources\Common\SelectField;
use App\Support\SanitizationHelper;
use Filament\Forms\Components\DateTimePicker;
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
                MoneyField::make('package_price'),
                MoneyField::make('negotiated_price'),
                SelectField::default('status')
                    ->options(PackageStatus::class)
                    ->required(),
                DateTimePicker::make('effective_date')
                    ->required(),
                DateTimePicker::make('expiry_date')
                    ->required(),
            ]);
    }
}
