<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Founder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Founder>
 */
final class FounderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'image' => $this->faker->paragraph(5),
            'social_media' => $this->faker->paragraph(50),
        ];
    }
}
