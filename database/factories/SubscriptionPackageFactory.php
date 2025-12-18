<?php

namespace Database\Factories;

use App\Enums\PackageStatus;
use App\Models\PackageDescription;
use App\Models\Payment;
use App\Models\SubscriptionPackage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubscriptionPackage>
 */
class SubscriptionPackageFactory extends Factory
{
    protected $model = SubscriptionPackage::class;

    /**
     * @throws \DateMalformedStringException
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first() ?? User::factory()->create();
        $payment = Payment::inRandomOrder()->first() ?? Payment::factory()->create();
        $packageDescription = PackageDescription::inRandomOrder()->first() ?? PackageDescription::factory()->create();

        $effectiveDate = $this->faker->dateTimeBetween('-1 year', 'now');
        $expiryDate = (clone $effectiveDate)->modify('+'.$packageDescription->period_in_months.' months');

        return [
            'user_id'           => $user->id,
            'payment_id'        => $payment->id,
            'package_description_id' => $packageDescription->id,
            'no_of_properties'  => $this->faker->numberBetween(1, 10),
            'no_of_support_team'=> $this->faker->numberBetween(1, 5),
            'status'            => $this->faker->randomElement([
                PackageStatus::ACTIVE,
                PackageStatus::INACTIVE,
            ]),
            'effective_date'    => $effectiveDate,
            'expiry_date'       => $expiryDate,
        ];
    }
}
