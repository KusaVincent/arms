<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Maintenance;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Maintenance>
 */
final class MaintenanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence(),
            'tenant_id' => Tenant::inRandomOrder()->first()->id ?? Tenant::factory(),
            'property_id' => Property::inRandomOrder()->first()->id ?? Property::factory(),
            'status' => $this->faker->randomElement(['Pending', 'In Progress', 'Completed']),
        ];
    }
}
