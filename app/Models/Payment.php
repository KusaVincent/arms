<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\PaymentCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

final class Payment extends Model
{
    use HasFactory, KeepsDeletedModels;

    protected $casts = [
        'payment_amount' => PaymentCast::class,
    ];

    public function leaseAgreement(): BelongsTo
    {
        return $this->belongsTo(LeaseAgreement::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
