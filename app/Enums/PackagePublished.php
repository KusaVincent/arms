<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PackagePublished: int implements HasColor, HasIcon, HasLabel
{
    case NO = 0;
    case YES = 1;

    public function getLabel(): string
    {
        return match ($this) {
            self::NO => 'No',
            self::YES => 'Yes',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::NO => 'warning',
            self::YES => 'success',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::NO => 'heroicon-s-x-mark',
            self::YES => 'heroicon-m-check',
        };
    }
}
