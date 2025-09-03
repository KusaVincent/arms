<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Contact>
 */
final class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'icon' => $this->faker->sentence,
            'link' => $this->faker->sentence,
            'label' => $this->faker->sentence,
            'link_text' => $this->faker->sentence,
            'section' => $this->faker->randomElement([0, 1, 2]),
        ];
    }
}
