<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

/**
 * @method static where(string $string, string $string1)
 */
class Operator extends BASEModel
{
    use KeepsDeletedModels;

    protected string $referencePrefix = 'OPR';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class)
            ->using(OperatorProperty::class)
            ->withPivot(['created_by'])
            ->withTimestamps();
    }
}
