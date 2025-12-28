<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

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
