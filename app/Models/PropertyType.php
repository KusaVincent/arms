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
 * @method static firstOrCreate(string[] $array)
 */
final class PropertyType extends Model
{
    use HasFactory, KeepsDeletedModels;

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
