<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\LeaseAgreement;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

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
        $term = $this->faker->randomElement(['Monthly', 'Yearly']);
        $property = Property::inRandomOrder()->first() ?? Property::factory()->create();

        $rent = str_replace(['KES ', ','], '', (string) $property->rent);

        $leaseAmount = ($term === 'Yearly')
            ? $rent * 12
            : $rent;

        $startDate = Carbon::instance($this->faker->dateTimeBetween('-1 month', 'now'));
        $endDate = (clone $startDate)->addMonth();

        if ($term === 'Yearly') {
            $startDate = Carbon::instance($this->faker->dateTimeBetween('-1 year', 'now'));
            $endDate = (clone $startDate)->addYear();
        }

        return [
            'lease_term' => $term,
            'lease_end_date' => $endDate,
            'lease_amount' => $leaseAmount,
            'property_id' => $property->id,
            'lease_start_date' => $startDate,
            'tenant_id' => Tenant::inRandomOrder()->first()->id ?? Tenant::factory(),
            'deposit_amount' => str_replace(['KES ', ','], '', (string) $property->deposit),
        ];
    }
}
