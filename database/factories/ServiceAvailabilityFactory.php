<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ServiceAvailability;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ServiceAvailability>
 */
final class ServiceAvailabilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service_key' => $this->faker->unique()->slug,
            'service_name' => $this->faker->words(3, true),
            'is_active' => $this->faker->boolean(80),
        ];
    }
}
