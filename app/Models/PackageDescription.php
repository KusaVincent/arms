<?php

namespace App\Models;

use App\Enums\PackageStatus;
use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

/**
 * @method static inRandomOrder()
 */
class PackageDescription extends Model implements Auditable
{
    use HasFactory, KeepsDeletedModels, AuditableTrait, Referenceable;

    protected string $referencePrefix = 'PKG';

    protected $attributes = [
        'period_in_months' => 0,
        'period_in_years' => 0,
        'status' => PackageStatus::INACTIVE,
    ];

    protected $casts = [
        'status' => PackageStatus::class,
    ];

    public function subscriptionPackages(): HasMany
    {
        return $this->hasMany(SubscriptionPackage::class);
    }
}
