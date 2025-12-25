<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Operator;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
final class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    private static ?string $password = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone_number' => $this->faker->phoneNumber(),
            'last_name' => $this->faker->lastName(),
            'first_name' => $this->faker->firstName(),
            'email' => fake()->unique()->safeEmail(),
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
            'user_type' => $this->faker->randomElement(['admin', 'operator', 'tenant']),
            'password' => self::$password ??= Hash::make('password'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes): array => [
            'email_verified_at' => null,
        ]);
    }

    public function operator(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_type' => 'operator',
        ]);
    }

    public function tenant(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_type' => 'tenant',
        ]);
    }

    public function withOperatorProfile(): static
    {
        return $this->afterCreating(function (User $user) {
            Operator::factory()->create(['user_id' => $user->id]);
        });
    }

    public function withTenantProfile(): static
    {
        return $this->afterCreating(function (User $user) {
            Tenant::factory()->create(['user_id' => $user->id]);
        });
    }
}
