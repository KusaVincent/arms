<?php

namespace App\Models;

use App\Enums\PackageStatus;
use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

class SubscriptionPackage extends BaseModel
{
    use KeepsDeletedModels;

    protected string $referencePrefix = 'SPI'; // model name . invoice

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
