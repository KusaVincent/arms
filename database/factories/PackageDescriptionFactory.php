<?php

namespace Database\Factories;

use App\Enums\PackageStatus;
use App\Models\PackageDescription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PackageDescription>
 */
class PackageDescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $properties = rand(2, 5);
        $price = $this->faker->numberBetween(10000, 50000);

        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(10),
            'monthly_package_price' => $price,
            'annual_package_price' => $price * 10,
            'properties' => $properties,
            'support_team' => $properties < 5
                ? rand(0, 3) : rand(5, 10),
            'status' => $this->faker->randomElement([
                PackageStatus::ACTIVE,
                PackageStatus::INACTIVE,
            ]),
        ];
    }
}
