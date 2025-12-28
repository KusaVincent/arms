<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\HigherOrderCollectionProxy;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

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
final class Location extends BaseModel
{
    use KeepsDeletedModels;

    protected string $referencePrefix = 'LOC';

    protected function townCity(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => $this->sanitizeString($value),
        );
    }

    protected function address(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => $this->sanitizeString($value),
        );
    }

    protected function area(): Attribute
    {
        return Attribute::make(
            set: fn ($value): string => $this->sanitizeString($value),
        );
    }

    private function sanitizeString(mixed $string): string
    {
        $clean = preg_replace('/\s+/', ' ', (string) $string);

        return ucwords(trim((string) $clean));
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    #[\Override]
    protected static function booted(): void
    {
        Location::saving(function ($location): void {
            $parts = array_filter([
                $location->town_city,
                $location->area,
                $location->address,
            ]);

            // take care of unique failure
            $location->full_address = implode(', ', $parts);
        });
    }
}
