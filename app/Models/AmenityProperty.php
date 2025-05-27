<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

/**
 * @method static create(array $array)
 */
final class AmenityProperty extends Pivot
{
    use HasFactory, KeepsDeletedModels;

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    // Amenity relationship
    public function amenity(): BelongsTo
    {
        return $this->belongsTo(Amenity::class);
    }
}
