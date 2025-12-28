<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static inRandomOrder()
 * @method static factory()
 * @method static create(mixed $about)
 */
class PaymentMethod extends BaseModel
{
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
