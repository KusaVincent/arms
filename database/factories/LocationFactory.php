<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Location>
 */
final class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'area' => $this->faker->state(),
            'town_city' => $this->faker->city(),
            'address' => $this->faker->streetAddress(),
            'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7977.869281592157!2d36.88060919482812!3d-1.2059144186415809!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f3e1696ccdbf7%3A0xd5954c38ce0ff11d!2sMirema%2C%20Nairobi!5e0!3m2!1sen!2ske!4v1746267386617!5m2!1sen!2ske',
        ];
    }
}
