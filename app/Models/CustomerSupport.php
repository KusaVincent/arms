<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

/**
 * @method static create(array $all)
 */
final class CustomerSupport extends Model
{
    use KeepsDeletedModels;

    public function getEmailAttribute($value): string
    {
        return strtolower((string) $value);
    }

    public function setEmailAttribute($value): void
    {
        $this->attributes['email'] = strtolower((string) $value);
    }

    public function getNameAttribute($value): string
    {
        return ucwords((string) $value);
    }

    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = ucwords((string) $value);
    }
}
