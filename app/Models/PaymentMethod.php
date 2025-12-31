<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

/**
 * @method static inRandomOrder()
 * @method static factory()
 * @method static create(mixed $about)
 */
class PaymentMethod extends BaseModel
{
    use KeepsDeletedModels;

    protected string $referencePrefix = 'PMD';

    protected $attributes = [
        'color' => 'gray',
    ];

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
