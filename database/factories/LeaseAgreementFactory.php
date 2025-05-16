<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\LeaseAgreement;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LeaseAgreement>
 */
final class LeaseAgreementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rent_amount' => $this->faker->numberBetween(1000, 5000),
            'lease_term' => $this->faker->randomElement(['Monthly', 'Yearly']),
            'deposit_amount' => $this->faker->numberBetween(500, 2000),
            'lease_start_date' => $this->faker->dateTimeBetween('-1 year'),
            'tenant_id' => Tenant::inRandomOrder()->first()->id ?? Tenant::factory(),
            'property_id' => Property::inRandomOrder()->first()->id ?? Property::factory(),
            'lease_end_date' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
