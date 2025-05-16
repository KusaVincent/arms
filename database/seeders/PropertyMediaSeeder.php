<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyMedia;
use Illuminate\Database\Seeder;

final class PropertyMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Property::all()->each(function ($property) {
            PropertyMedia::factory()->create([
                'property_id' => $property->id,
            ]);
        });
    }
}
