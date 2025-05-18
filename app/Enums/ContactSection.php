<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ContactSection: string implements HasColor, HasLabel
{
    case ALL = 'all';
    case CONTACT = 'contact';
    case FOOTER = 'footer';

    public function getColor(): string
    {
        return match ($this) {
            self::ALL => 'success',
            self::CONTACT => 'danger',
            self::FOOTER => 'warning',
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
