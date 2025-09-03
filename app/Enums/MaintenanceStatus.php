<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum MaintenanceStatus: int implements HasColor, HasLabel
{
    case PENDING = 0;
    case COMPLETED = 1;
    case IN_PROGRESS = 2;

    public function getColor(): string
    {
        return match ($this) {
            self::PENDING => 'danger',
            self::COMPLETED => 'success',
            self::IN_PROGRESS => 'warning',
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
