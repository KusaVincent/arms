<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ActiveServiceAvailability;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * @method static where(string $string, $serviceKey)
 * @method static create(array $serviceAvailability)
 */
final class ServiceAvailability extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    protected $casts = [
        'is_active' => ActiveServiceAvailability::class,
    ];

    protected $attributes = [
        'is_active' => ActiveServiceAvailability::YES,
    ];
}
