<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Operator>
 */
class OperatorFactory extends Factory
{
    protected static bool $ownerGenerated = false;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => 'Owner',
            'user_id' => User::factory(),
            'owner_id' => null,
        ];
    }

    public function support(string $type = 'Caretaker'): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => $type,
        ]);
    }
}
