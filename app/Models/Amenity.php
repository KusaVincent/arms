<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

/**
 * @method static inRandomOrder()
 * @method static create(string[] $amenity)
 */
final class Amenity extends Model
{
    use HasFactory,KeepsDeletedModels,LogsActivity, Referenceable;

    protected string $referencePrefix = 'AMT';

    protected $attributes = [
        'amenity_icon' => 'house',
        'amenity_icon_color' => 'text-blue-500',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class)
            ->using(AmenityProperty::class)
            ->withPivot(['created_by'])
            ->withTimestamps();
    }
}
