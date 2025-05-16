<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Tenant>
 */
final class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone' => $this->faker->phoneNumber(),
            'last_name' => $this->faker->lastName(),
            'first_name' => $this->faker->firstName(),
            'password' => Hash::make('password'),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
