<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\PaymentCast;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

/**
 * @method static inRandomOrder()
 */
final class LeaseAgreement extends BaseModel
{
    use KeepsDeletedModels;

    protected string $referencePrefix = 'LAG';

    protected $casts = [
        'rent_amount' => PaymentCast::class,
        'deposit_amount' => PaymentCast::class,
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function payments(): MorphMany
    {
        return $this->morphMany(Payment::class, 'payable');
    }
}
