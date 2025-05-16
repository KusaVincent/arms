<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Seeder;

final class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $propertyTypes = [
            ['type_name' => 'Studio'],
            ['type_name' => 'Apartment'],
            ['type_name' => 'Bungalow'],
            ['type_name' => 'Mansion'],
            ['type_name' => 'Townhouse'],
        ];

        foreach ($propertyTypes as $propertyType) {
            PropertyType::firstOrCreate(['type_name' => $propertyType['type_name']]);
        }
    }
}
