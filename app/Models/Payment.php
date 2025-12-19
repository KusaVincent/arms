<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\PaymentCast;
use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

final class Payment extends Model
{
    use HasFactory,KeepsDeletedModels, LogsActivity, Referenceable;

    protected string $referencePrefix = 'PAY';

    protected $casts = [
        'payment_amount' => PaymentCast::class,
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

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
