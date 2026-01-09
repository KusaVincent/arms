<?php

namespace App\Support;

class SanitizationHelper
{
    public static function stripFormatting($value): ?float
    {
        if (is_string($value)) {
            return (float) str_replace(['KES ', ','], '', $value);
        }

        if ($value === null) {
            return 0.00;
        }

        return $value;
    }
}
