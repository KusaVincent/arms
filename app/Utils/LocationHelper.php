<?php

namespace App\Utils;

use App\Models\Location;
use Illuminate\Database\Eloquent\Builder;

class LocationHelper
{
    /**
     * Get the full details for a location by its ID.
     */
    public static function getFullDetails(int $id): ?string
    {
        return optional(Location::find($id))->full_details;
    }

    /**
     * Search locations based on a search query.
     */
    public static function getSearchResults(string $search): array
    {
        return Location::query()
            ->where('area', 'like', "%{$search}%")
            ->orWhere('town_city', 'like', "%{$search}%")
            ->orWhere('address', 'like', "%{$search}%")
            ->get()
            ->pluck('full_details', 'id')
            ->toArray();
    }

    /**
     * Get all locations formatted for use as options.
     */
    public static function getOptions(): array
    {
        return Location::all()->mapWithKeys(fn($location) => [
            $location->id => implode(', ', array_filter([
                $location->town_city,
                $location->area,
                $location->address,
            ])),
        ])->toArray();
    }

    /**
     * Format location details as a single string.
     */
    public static function formatLocation($location): ?string
    {
        $parts = [];
        if ($location?->town_city) {
            $parts[] = $location->town_city;
        }
        if ($location?->area) {
            $parts[] = $location->area;
        }
        if ($location?->address) {
            $parts[] = $location->address;
        }

        return $parts === [] ? null : implode(', ', $parts);
    }

    /**
     * Apply a search query to the location relationship.
     */
    public static function applyLocationSearch(Builder $query, string $search): Builder
    {
        return $query
            ->orWhereRelation('location', 'town_city', 'like', "%{$search}%")
            ->orWhereRelation('location', 'area', 'like', "%{$search}%")
            ->orWhereRelation('location', 'address', 'like', "%{$search}%");
    }
}
