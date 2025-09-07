<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * @method static create(string[] $array)
 */
final class About extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, softDeletes;
}
