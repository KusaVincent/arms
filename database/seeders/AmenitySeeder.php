<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;

final class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenities = [
            [
                'amenity_name' => 'Playground',
                'amenity_icon' => 'fa-football-ball',
                'amenity_icon_color' => 'text-blue-500',
                'amenity_description' => 'A safe playground for kids.',
            ],
            [
                'amenity_name' => 'Balcony',
                'amenity_icon' => 'fa-table',
                'amenity_icon_color' => 'text-blue-500',
                'amenity_description' => 'Private balcony with great views.',
            ],
            [
                'amenity_name' => 'WiFi',
                'amenity_icon' => 'fa-wifi',
                'amenity_icon_color' => 'text-blue-500',
                'amenity_description' => 'Enjoy high-speed wireless internet.',
            ],
            [
                'amenity_name' => 'Closet',
                'amenity_icon' => 'fa-refrigerator',
                'amenity_icon_color' => 'text-blue-500',
                'amenity_description' => 'Spacious closet for your storage needs.',
            ],
            [
                'amenity_name' => 'Shower',
                'amenity_icon' => 'fa-shower',
                'amenity_icon_color' => 'text-blue-500',
                'amenity_description' => 'Modern shower facilities for your convenience.',
            ],
            [
                'amenity_name' => 'Water',
                'amenity_icon' => 'fa-water',
                'amenity_icon_color' => 'text-blue-500',
                'amenity_description' => 'Reliable water supply to meet your daily needs.',
            ],
        ];

        foreach ($amenities as $amenity) {
            Amenity::create($amenity);
        }
    }
}
