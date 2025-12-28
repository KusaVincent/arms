<?php

namespace App\Models;

use App\Enums\PackagePublished;
use App\Enums\PackageStatus;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

/**
 * @method static inRandomOrder()
 */
class PackageDescription extends BaseModel
{
    use KeepsDeletedModels;

    protected string $referencePrefix = 'PKG';

    protected $attributes = [
        'published' => PackagePublished::NO,
        'status' => PackageStatus::INACTIVE,
    ];

    protected $casts = [
        'status' => PackageStatus::class,
        'published' => PackagePublished::class,
    ];

    public function subscriptionPackages(): HasMany
    {
        return $this->hasMany(PackageSubscription::class);
    }
}
