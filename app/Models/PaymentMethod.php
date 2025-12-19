<?php

namespace App\Models;

use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @method static inRandomOrder()
 * @method static factory()
 * @method static create(mixed $about)
 */
class PaymentMethod extends Model
{
    use HasFactory, LogsActivity, Referenceable;

    protected string $referencePrefix = 'PMT';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
