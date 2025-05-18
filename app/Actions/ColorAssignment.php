<?php

namespace App\Actions;

class ColorAssignment
{
    private static array $colorMap = [];

    private static array $colorPool = [
        'primary',
        'success',
        'warning',
        'danger',
        'gray',
    ];

    public static function getColor(string $value): string
    {
        if (self::$colorMap === [] && self::$colorPool !== []) {
            shuffle(self::$colorPool);
        }

        if (! isset(self::$colorMap[$value])) {
            self::$colorMap[$value] = array_shift(self::$colorPool) ?? 'primary';
        }

        return self::$colorMap[$value];
    }
}
