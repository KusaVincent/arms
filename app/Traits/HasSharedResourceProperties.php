<?php

namespace App\Traits;

use Filament\Support\Icons\Heroicon;

trait HasSharedResourceProperties
{
    public static function globalSearchResultsLimit(): int
    {
        return 20;
    }

    public static function getActiveNavigationIcon(): Heroicon
    {
        return Heroicon::OutlinedCheckBadge;
    }
}
