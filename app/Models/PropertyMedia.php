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

    public function getImageOneAttribute($value): string
    {
        return 'property/' . $value;
    }

    public function getImageTwoAttribute($value): string
    {
        return 'property/' . $value;
    }

    public function getImageThreeAttribute($value): string
    {
        return 'property/' . $value;
    }

    public function getImageFourAttribute($value): string
    {
        return 'property/' . $value;
    }

    public function getImageFiveAttribute($value): string
    {
        return 'property/' . $value;
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
