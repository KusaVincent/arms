<?php

namespace App\Filament\ReusableResources\Common;



use App\Support\SanitizationHelper;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;

class MoneyField
{
    public static function make(string $name, bool $required = true): TextInput
    {
        return TextInput::make($name)
                ->required($required)
                ->formatStateUsing(fn ($state, $livewire) => $livewire instanceof EditRecord
                    ? SanitizationHelper::stripFormatting($state)
                    : $state
                );
    }
}
