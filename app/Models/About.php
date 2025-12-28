<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(string[] $array)
 */
final class About extends BaseModel
{
    use softDeletes;

    protected string $referencePrefix = 'ABT';
}
