<?php

namespace App\Models;

use App\Enums\PackageStatus;
use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;
use OwenIt\Auditing\Auditable as AuditableTrait;

class SubscriptionPackage extends Model implements Auditable
{
    use HasFactory, KeepsDeletedModels, Referenceable, AuditableTrait;

    protected string $referencePrefix = 'SPI'; //mode name . invoice

    protected $attributes = [
        'no_of_properties' => 0,
        'no_of_support_team' => 0,
        'status' => PackageStatus::INACTIVE,
    ];

    protected $casts = [
        'status' => PackageStatus::class,
    ];

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function packageDescription(): BelongsTo
    {
        return $this->belongsTo(PackageDescription::class);
    }
}
