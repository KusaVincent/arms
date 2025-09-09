<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * @method static create(array $founder)
 */
final class Founder extends Model implements Auditable
{
    use HasFactory, softDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $casts = [
        'social_media' => 'json:unicode',
    ];
}
