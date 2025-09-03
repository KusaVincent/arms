<?php

namespace App\Utils;

class SanitizationHelper
{
    public static function stripFormatting($value): float
    {
        if (is_string($value)) {
            return (float) str_replace(['Ksh ', ','], '', $value);
        }

        return $value;
    }
}
