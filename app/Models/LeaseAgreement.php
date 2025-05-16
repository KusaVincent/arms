<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\PaymentCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

/**
 * @method static inRandomOrder()
 */
final class LeaseAgreement extends Model
{
    use HasFactory, KeepsDeletedModels;

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

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
