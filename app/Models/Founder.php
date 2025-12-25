<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @method static create(array $founder)
 */
final class Founder extends BaseModel
{
    use softDeletes;

    protected string $referencePrefix = 'FND';

    protected $casts = [
        'social_media' => 'json:unicode',
    ];
}
