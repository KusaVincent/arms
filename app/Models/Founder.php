<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use \OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * @method static create(array $founder)
 */
final class Founder extends Model implements Auditable
{
    use HasFactory, softDeletes, AuditableTrait, Referenceable;

    protected string $referencePrefix = 'FND';

    protected $casts = [
        'social_media' => 'json:unicode',
    ];
}
