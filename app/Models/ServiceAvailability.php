<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ActiveServiceAvailability;
use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @method static where(string $string, $serviceKey)
 * @method static create(array $serviceAvailability)
 */
final class ServiceAvailability extends Model
{
    use HasFactory, LogsActivity, Referenceable, SoftDeletes;

    protected string $referencePrefix = 'SAV';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    protected $casts = [
        'is_active' => ActiveServiceAvailability::class,
    ];

    protected $attributes = [
        'is_active' => ActiveServiceAvailability::YES,
    ];
}
