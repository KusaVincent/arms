<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Property;
use App\Models\PropertyMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PropertyMedia>
 */
final class PropertyMediaFactory extends Factory
{
    private array $videos = ['property/video/test-videos.mp4'];

    private array $images = ['property/images/prop.jpg', 'property/images/property.jpg'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'video' => fake()->randomElement($this->videos),
            'image_one' => fake()->randomElement($this->images),
            'image_two' => fake()->randomElement($this->images),
            'image_three' => fake()->randomElement($this->images),
            'image_four' => fake()->randomElement($this->images),
            'image_five' => fake()->randomElement($this->images),
            'property_id' => Property::inRandomOrder()->first()->id ?? Property::factory(),
        ];
    }
}
