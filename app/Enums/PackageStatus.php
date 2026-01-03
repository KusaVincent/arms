<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PackageStatus: int implements HasColor, HasLabel
{
    case ACTIVE = 1;
    case EXPIRED = 2;
    case INACTIVE = 0;

    public function getColor(): array
    {
        return match ($this) {
            self::EXPIRED => Color::Red,
            self::ACTIVE => Color::Emerald,
            self::INACTIVE => Color::Yellow,
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'In Active',
            self::EXPIRED => 'Expired',
        };
    }
}
