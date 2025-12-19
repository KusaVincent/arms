<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

/**
 * @method static create(array $array)
 * @method static where(string $string, $id)
 * @method static firstOrCreate(array $array, array $array1)
 */
class PropertyUser extends Pivot
{
    use HasFactory, KeepsDeletedModels;

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
