<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array|mixed[] $data)
 * @method static factory(int $int)
 * @method static where(string $string, string $string1)
 * @method static find(int $int)
 * @method static firstOrCreate(string[] $array)
 */
class Client extends Model
{
    use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name'],
            ],
        ];
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
