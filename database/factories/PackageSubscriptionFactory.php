<?php

namespace Database\Factories;

use App\Enums\PackageStatus;
use App\Models\PackageDescription;
use App\Models\Payment;
use App\Models\PackageSubscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PackageSubscription>
 */
class PackageSubscriptionFactory extends Factory
{
    protected $model = PackageSubscription::class;

    /**
     * @throws \DateMalformedStringException
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first() ?? User::factory()->create();
        $packageDescription = PackageDescription::inRandomOrder()->first() ?? PackageDescription::factory()->create();

        $period = $this->faker->randomElement(['Month', 'Year']);

        $effectiveDate = Carbon::instance($this->faker->dateTimeBetween('-1 year', 'now'));

        $expiryDate = ($period === 'Month')
            ? (clone $effectiveDate)->addMonth()
            : (clone $effectiveDate)->addYear();

        return [
            'user_id' => $user->id,
            'package_description_id' => $packageDescription->id,
            'no_of_properties' => $packageDescription->properties,
            'no_of_support_team' => $packageDescription->support_team,
            'status' => $this->faker->randomElement([
                PackageStatus::ACTIVE,
                PackageStatus::INACTIVE,
            ]),
            'effective_date' => $effectiveDate,
            'expiry_date' => $expiryDate,
            'package_period' => $period,
            'package_price'=>$period == 'Month'
                ? $packageDescription->monthly_package_price
                : $packageDescription->annual_package_price,
            'negotiated_price' => null,
        ];
    }
}
