<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class PaymentCast implements CastsAttributes
{
    /**
     * Cast the given value for display (no decimals).
     *
     * @param  array<string, string>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): string
    {
        return 'KES ' . number_format($value);
    }

    /**
     * Prepare the given value for storage (store as integer, always ceil).
     *
     * @param  array<string, int>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): int
    {
        if (is_null($value)) return 0;

        $cleaned = preg_replace('/[^0-9.]/', '', str_replace(['KES ', ','], '', (string) $value));

        return (int) ceil((float) $cleaned);
    }
}
