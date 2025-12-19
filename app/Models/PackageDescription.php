<?php

namespace App\Models;

use App\Enums\PackagePublished;
use App\Enums\PackageStatus;
use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

/**
 * @method static inRandomOrder()
 */
class PackageDescription extends Model
{
    use HasFactory,KeepsDeletedModels, LogsActivity, Referenceable;

    protected string $referencePrefix = 'PKG';

    protected $attributes = [
        'period_in_months' => 0,
        'period_in_years' => 0,
        'published' => PackagePublished::NO,
        'status' => PackageStatus::INACTIVE,
    ];

    protected $casts = [
        'status' => PackageStatus::class,
        'published' => PackagePublished::class,
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    public function subscriptionPackages(): HasMany
    {
        return $this->hasMany(SubscriptionPackage::class);
    }
}
