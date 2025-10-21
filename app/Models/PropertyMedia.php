<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

final class PropertyMedia extends Model implements Auditable
{
    use AuditableTrait, HasFactory, KeepsDeletedModels, Referenceable;

    protected string $referencePrefix = 'PPM';

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
