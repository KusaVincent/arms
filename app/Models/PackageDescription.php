<?php

namespace App\Models;

use App\Casts\PaymentCast;
use App\Enums\PackagePublished;
use App\Enums\PackageStatus;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

/**
 * @method static inRandomOrder()
 * @method static count()
 */
class PackageDescription extends BaseModel
{
    use KeepsDeletedModels;

    protected string $referencePrefix = 'PKG';

    protected $attributes = [
        'published' => PackagePublished::NO,
        'status' => PackageStatus::INACTIVE,
        'annual_package_price' => PaymentCast::class,
        'monthly_package_price' => PaymentCast::class,
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
