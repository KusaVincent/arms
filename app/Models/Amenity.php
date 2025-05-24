<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

/**
 * @method static inRandomOrder()
 * @method static create(string[] $amenity)
 */
final class Amenity extends Model
{
    use HasFactory, KeepsDeletedModels;

    protected $attributes = [
        'amenity_icon' => 'house',
        'amenity_icon_color' => 'text-blue-500',
    ];

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class)
            ->using(AmenityProperty::class)
            ->withPivot(['created_by'])
            ->withTimestamps();
    }
}
