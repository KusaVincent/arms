<?php

namespace App\Models;

use App\Casts\PaymentCast;
use App\Enums\PackageStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

/**
 * @method static inRandomOrder()
 */
class PackageSubscription extends BaseModel
{
    use KeepsDeletedModels;

    protected string $referencePrefix = 'SPI'; // model name . invoice

    protected $attributes = [
        'no_of_properties' => 0,
        'no_of_support_team' => 0,
        'status' => PackageStatus::INACTIVE,
        'package_price' => PaymentCast::class,
        'negotiated_price' => PaymentCast::class,
    ];

    protected $casts = [
        'status' => PackageStatus::class,
    ];

    public function payment(): MorphMany
    {
        return $this->morphMany(Payment::class, 'payable');
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class);
    }

    public function packageDescription(): BelongsTo
    {
        return $this->belongsTo(PackageDescription::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', PackageStatus::ACTIVE)
            ->where('expiry_date', '>', now());
    }
}
