<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

final class PropertyMedia extends Model
{
    use HasFactory,KeepsDeletedModels, LogsActivity, Referenceable;

    protected string $referencePrefix = 'PPM';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
