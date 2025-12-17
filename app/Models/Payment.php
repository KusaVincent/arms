<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\PaymentCast;
use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

final class Payment extends Model implements Auditable
{
    use AuditableTrait, HasFactory, KeepsDeletedModels, Referenceable;

    protected string $referencePrefix = 'PAY';

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

    public function subscriptionPackage(): HasOne
    {
        return $this->hasOne(SubscriptionPackage::class);
    }

}
