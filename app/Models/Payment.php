<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\PaymentCast;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

final class Payment extends BaseModel
{
    use KeepsDeletedModels;

    protected string $referencePrefix = 'PAY';

    protected $casts = [
        'payment_amount' => PaymentCast::class,
    ];

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function payable(): BelongsTo
    {
        return $this->morphTo();
    }
}
