<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;

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

    public function getColor(): array
    {
        return match ($this) {
            self::NO => Color::Yellow,
            self::YES => Color::Green,
        };
    }

    public function getIcon(): Heroicon
    {
        return match ($this) {
            self::NO => Heroicon::XMark,
            self::YES => Heroicon::Check,
        };
    }
}
