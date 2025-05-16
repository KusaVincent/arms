<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\LeaseAgreement;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
final class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payment_date' => $this->faker->dateTimeBetween('-1 year'),
            'payment_amount' => $this->faker->numberBetween(500, 5000),
            'payment_method' => $this->faker->randomElement(['Cash', 'Card', 'Bank Transfer', 'M-Pesa']),
            'lease_agreement_id' => LeaseAgreement::inRandomOrder()->first()->id ?? LeaseAgreement::factory(),
        ];
    }
}
