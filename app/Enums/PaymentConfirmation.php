<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;

enum PaymentConfirmation: int implements HasColor, HasIcon, HasLabel
{
    case CONFIRMED = 2;
    case NOT_CONFIRMED = 0;
    case PAID_AWAITING_CONFIRMATION = 1;

    public function getLabel(): string
    {
        return match ($this) {
            self::CONFIRMED => 'Confirmed',
            self::NOT_CONFIRMED => 'Not Confirmed',
            self::PAID_AWAITING_CONFIRMATION => 'Paid Awaiting Confirmation',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::CONFIRMED => 'primary',
            self::NOT_CONFIRMED => 'danger',
            self::PAID_AWAITING_CONFIRMATION => 'warning',
        };
    }

    public function getIcon(): Heroicon
    {
        return match ($this) {
            self::CONFIRMED => Heroicon::CheckCircle,
            self::NOT_CONFIRMED => Heroicon::XCircle,
            self::PAID_AWAITING_CONFIRMATION => Heroicon::CircleStack,
        };
    }
}
