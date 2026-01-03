<?php

namespace App\Models;

use App\Enums\PackageStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

/**
 * @method static where(string $string, string $string1)
 * @method static create(array $array)
 * @method static find(mixed $owner_id)
 * @method static whereNot(string $string, string $string1)
 * @method static count()
 *
 * @property mixed $owner_id
 * @property mixed $owner
 */
class Operator extends BaseModel
{
    use KeepsDeletedModels;

    protected string $referencePrefix = 'OPR';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class)
            ->using(OperatorProperty::class)
            ->withPivot(['created_by'])
            ->withTimestamps();
    }

    public function packageSubscriptions(): HasMany
    {
        return $this->hasMany(PackageSubscription::class);
    }

    public function owner()
    {
        return $this->belongsTo(Operator::class, 'owner_id');
    }

    public function supportTeam()
    {
        return $this->hasMany(Operator::class, 'owner_id');
    }

    public function activeSubscription()
    {
        if ($this->owner_id) {
            return Operator::find($this->owner_id)->activeSubscription();
        }

        return $this->packageSubscriptions()
            ->where('status', PackageStatus::ACTIVE)
            ->where('expiry_date', '>', now())
            ->latest()
            ->first();
    }

    public function getEffectiveSubscriptionAttribute()
    {
        if ($this->owner_id) {
            return $this->owner->activeSubscription();
        }

        return $this->activeSubscription();
    }

    protected function userName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->user?->name ?? 'N/A',
        );
    }
}
