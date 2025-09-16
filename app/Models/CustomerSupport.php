<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;
use \OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * @method static create(array $all)
 */
final class CustomerSupport extends Model implements Auditable
{
    use KeepsDeletedModels, AuditableTrait, Referenceable;

    protected string $referencePrefix = 'CUS';

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
