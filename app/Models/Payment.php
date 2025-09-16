<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\PaymentCast;
use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;
use \OwenIt\Auditing\Auditable as AuditableTrait;

final class Payment extends Model implements Auditable
{
    use HasFactory, KeepsDeletedModels, AuditableTrait, Referenceable;

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
}
