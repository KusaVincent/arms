<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * @method static inRandomOrder()
 * @method static factory()
 * @method static create(mixed $about)
 */
class PaymentMethod extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
