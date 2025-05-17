<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

final class PropertyMedia extends Model
{
    use HasFactory, KeepsDeletedModels;

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
