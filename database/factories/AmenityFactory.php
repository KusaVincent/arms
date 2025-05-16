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
                'icon' => 'fa-water',
                'description' => 'Reliable water supply to meet your daily needs.',
            ],
            'Parking' => [
                'icon' => 'fa-car',
                'description' => 'Secure and convenient parking for your vehicles.',
            ],
            'Gym' => [
                'icon' => 'fa-dumbbell',
                'description' => 'Access a fully equipped gym for your fitness needs.',
            ],
            'Security' => [
                'icon' => 'fa-lock',
                'description' => '24/7 security to ensure your safety and peace of mind.',
            ],
            'Balcony' => [
                'icon' => 'fa-table',
                'description' => 'A private balcony offering stunning views and fresh air.',
            ],
            'Swimming Pool' => [
                'icon' => 'fa-swimmer',
                'description' => 'Relax in the spacious and well-maintained swimming pool.',
            ],
            'WiFi' => [
                'icon' => 'fa-wifi',
                'description' => 'Enjoy high-speed wireless internet for seamless browsing and streaming.',
            ],
        ];

        $amenityName = $this->faker->randomElement(array_keys($amenities));
        $details = $amenities[$amenityName];

        return [
            'amenity_name' => $amenityName,
            'amenity_icon' => $details['icon'],
            'amenity_icon_color' => $this->faker->randomElement([
                'text-blue-500',
                'text-red-500',
                'text-green-500',
                'text-yellow-500',
                'text-purple-500',
                'text-gray-500',
            ]),
            'amenity_description' => $details['description'],
        ];
    }
}
