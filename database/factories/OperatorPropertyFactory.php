<?php

namespace Database\Factories;

use App\Models\Operator;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OperatorProperty>
 */
class OperatorPropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'operator_id' => Operator::inRandomOrder()->first()->id ?? Operator::factory(),
            'property_id' => Property::inRandomOrder()->first()->id ?? Property::factory(),
        ];
    }
}
