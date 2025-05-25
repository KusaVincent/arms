<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

/**
 * @method static select(string $string, string $string1)
 * @method static inRandomOrder()
 * @method static find($value)
 * @property mixed $town_city
 * @property mixed $area
 * @property mixed $address
 */
final class Location extends Model
{
    use HasFactory, KeepsDeletedModels;

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    public function getLocationSummaryAttribute(): string
    {
        return $this->town_city . ', ' . $this->area . ', ' . $this->address;
    }
}
