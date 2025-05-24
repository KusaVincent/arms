<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Amenity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Amenity>
 */
final class AmenityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amenities = [
            'Water' => [
                'icon' => 'water',
                'description' => 'Reliable water supply to meet your daily needs.',
            ],
            'Parking' => [
                'icon' => 'car',
                'description' => 'Secure and convenient parking for your vehicles.',
            ],
            'Gym' => [
                'icon' => 'dumbbell',
                'description' => 'Access a fully equipped gym for your fitness needs.',
            ],
            'Security' => [
                'icon' => 'lock',
                'description' => '24/7 security to ensure your safety and peace of mind.',
            ],
            'Balcony' => [
                'icon' => 'table',
                'description' => 'A private balcony offering stunning views and fresh air.',
            ],
            'Swimming Pool' => [
                'icon' => 'swimmer',
                'description' => 'Relax in the spacious and well-maintained swimming pool.',
            ],
            'WiFi' => [
                'icon' => 'wifi',
                'description' => 'Enjoy high-speed wireless internet for seamless browsing and streaming.',
            ],
        ];

        $amenityIconColor = $this->faker->randomElement([
            'blue-500',
            'red-500',
            'green-500',
            'yellow-500',
            'purple-500',
            'gray-500',
        ]);

        $amenityName = $this->faker->randomElement(array_keys($amenities));
        $details = $amenities[$amenityName];

        return [
            'amenity_name' => $amenityName,
            'amenity_icon' => $details['icon'],
            'amenity_icon_color' => $amenityIconColor,
            'amenity_description' => $details['description'],
        ];
    }
}
