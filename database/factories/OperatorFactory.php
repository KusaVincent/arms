<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

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
        // If we haven't made an owner yet, make one now.
        if (!static::$ownerGenerated) {
            static::$ownerGenerated = true;
            return [
                'type' => 'Owner',
            ];
        }

        // Otherwise, only pick from the remaining types.
        return [
            'type' => fake()->randomElement(['Caretaker', 'Maintainer']),
        ];
    }
}
