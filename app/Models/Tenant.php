<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

/**
 * @property mixed $middle_name
 * @property mixed $last_name
 * @property mixed $first_name
 *
 * @template TFactory of Factory
 *
 * @mixin Model
 *
 * @method static inRandomOrder()
 */
final class Tenant extends BaseModel
{
    use KeepsDeletedModels;

    protected string $referencePrefix = 'TNT';

    /**
     * @return HasMany<LeaseAgreement, Tenant>
     */
    public function leaseAgreements(): HasMany
    {
        return $this->hasMany(LeaseAgreement::class);
    }

    /**
     * @return HasMany<Maintenance, Tenant>
     */
    public function maintenance(): HasMany
    {
        return $this->hasMany(Maintenance::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
