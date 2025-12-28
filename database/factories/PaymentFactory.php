<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\LeaseAgreement;
use App\Models\PackageSubscription;
use App\Models\Payment;
use App\Models\PaymentMethod;
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
            'payment_method_id' => PaymentMethod::inRandomOrder()->first()->id ?? PaymentMethod::factory(),
            'payable_id' => LeaseAgreement::inRandomOrder()->first()->id ?? LeaseAgreement::factory(),
            'payable_type' => new LeaseAgreement()->getMorphClass(),
        ];
    }

    public function forSubscription(): self
    {
        return $this->state(fn (array $attributes) => [
            'payable_id' => PackageSubscription::inRandomOrder()->first()->id ?? PackageSubscription::factory(),
            'payable_type' => new PackageSubscription()->getMorphClass(),
        ]);
    }
}
