<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PackageStatus: int implements HasColor, HasLabel
{
    case INACTIVE = 0;
    case ACTIVE = 1;
    case EXPIRED = 2;

    public function getColor(): string
    {
        return match ($this) {
            self::EXPIRED => 'danger',
            self::ACTIVE => 'success',
            self::INACTIVE => 'warning',
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
