<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\Property;
use App\Models\PropertyAmenity;
use Illuminate\Database\Seeder;

final class PropertyAmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::all()->each(function ($property): void {
            Amenity::inRandomOrder()
                ->take(fake()->numberBetween(1, 5))
                ->pluck('id')
                ->each(function ($amenityId) use ($property): void {
                    PropertyAmenity::create([
                        'property_id' => $property->id,
                        'amenity_id' => $amenityId,
                    ]);
                });
        });
    }
}
