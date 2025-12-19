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
        $periodMonths = $this->faker->numberBetween(1, 24);
        $periodYears = (int) ($periodMonths / 12);

        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(10),
            'period_in_months' => $periodMonths,
            'period_in_years' => $periodYears,
            'status' => $this->faker->randomElement([
                PackageStatus::ACTIVE,
                PackageStatus::INACTIVE,
            ]),
        ];
    }
}
