<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @method static firstOrCreate(array $array)
 * @method static pluck(string $string, string $string1)
 */
class Role extends SpatieRole
{
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class);
    }
}
