<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum MaintenanceStatus: string implements HasColor, HasLabel
{
    case PENDING = 'Pending';
    case COMPLETED = 'Completed';
    case IN_PROGRESS = 'In Progress';

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
