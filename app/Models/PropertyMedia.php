<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

final class PropertyMedia extends BaseModel
{
    use KeepsDeletedModels;

    protected string $referencePrefix = 'PPM';

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    protected function propertyName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->property?->name ?? 'N/A',
        );
    }
}
