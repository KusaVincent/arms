<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ContactSection: int implements HasColor, HasLabel
{
    case ALL = 0;
    case CONTACT = 1;
    case FOOTER = 2;

    public function getColor(): array
    {
        return match ($this) {
            self::ALL => Color::Green,
            self::CONTACT => Color::Blue,
            self::FOOTER => Color::Fuchsia,
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::ALL => 'All',
            self::CONTACT => 'Contact',
            self::FOOTER => 'Footer',
        };
    }
}
