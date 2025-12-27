<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Location;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Property>
 */
final class PropertyFactory extends Factory
{
    private array $images = ['property/images/prop.jpg', 'property/images/property.jpg'];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rent = $this->faker->numberBetween(15000, 500000);

        $maxDeposit = (int) ($rent * 1.5) - 1;

        return [
            'rent' => $rent,
            'available' => $this->faker->boolean(),
            'negotiable' => $this->faker->boolean(),
            'description' => $this->faker->paragraph(),
            'name' => $this->faker->words(3, true),
            'property_image' => fake()->randomElement($this->images),
            'deposit' => $this->faker->numberBetween($rent, $maxDeposit),
            'location_id' => Location::inRandomOrder()->first()->id ?? Location::factory(),
            'property_type_id' => PropertyType::inRandomOrder()->first()->id ?? PropertyType::factory(),
        ];
    }
}
