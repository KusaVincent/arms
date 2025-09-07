<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

final class PropertyMedia extends Model implements Auditable
{
    use HasFactory, KeepsDeletedModels;
    use \OwenIt\Auditing\Auditable;

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
