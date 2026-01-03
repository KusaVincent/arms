<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum MaintenanceStatus: int implements HasColor, HasLabel
{
    case PENDING = 0;
    case COMPLETED = 1;
    case IN_PROGRESS = 2;
    case ASSIGNED = 3;

    public function getColor(): array|null|string
    {
        return match ($this) {
            self::PENDING => Color::Red,
            self::COMPLETED => Color::Green,
            self::ASSIGNED => Color::Blue,
            self::IN_PROGRESS => Color::Yellow,
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::COMPLETED => 'Completed',
            self::IN_PROGRESS => 'In Progress',
        };
    }
}
