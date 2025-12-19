<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
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
final class Tenant extends Model
{
    use HasFactory,KeepsDeletedModels, LogsActivity, Referenceable;

    protected string $referencePrefix = 'TNT';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

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

    public function getFullnameAttribute(): string
    {
        return $this->first_name.' '.$this->middle_name.' '.$this->last_name;
    }
}
