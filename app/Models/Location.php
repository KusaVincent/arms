<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\HigherOrderCollectionProxy;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;
use \OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * @method static select(string $string, string $string1)
 * @method static inRandomOrder()
 * @method static find($value)
 *
 * @property mixed $town_city
 * @property mixed $area
 * @property mixed $address
 * @property HigherOrderCollectionProxy|mixed|null $full_details
 */
final class Location extends Model implements Auditable
{
    use HasFactory, KeepsDeletedModels, AuditableTrait, Referenceable;

    protected string $referencePrefix = 'LOC';

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    protected static function booted(): void
    {
        Location::saving(function ($location): void {
            $parts = array_filter([
                trim((string) $location->town_city),
                trim((string) $location->area),
                trim((string) $location->address),
            ]);

            // take care of unique failure
            $location->full_address = implode(', ', $parts);
        });
    }
}
