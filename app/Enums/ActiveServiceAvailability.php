<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ActiveServiceAvailability: int implements HasColor, HasIcon, HasLabel
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

    /**
     * Convert the enum case to its boolean representation.
     */
    public function toBool(): bool
    {
        return $this === self::YES;
    }

    /**
     * Get the enum case from a boolean value.
     */
    public static function fromBool(bool $value): self
    {
        return $value ? self::YES : self::NO;
    }
}
