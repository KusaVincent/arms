<?php

namespace Database\Seeders;

use App\Enums\PackageStatus;
use App\Models\Operator;
use App\Models\PackageDescription;
use App\Models\PackageSubscription;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class PackageSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owners = Operator::whereNull('owner_id')->get();
        $packageDescriptions = PackageDescription::all();

        if ($owners->isEmpty() || $packageDescriptions->isEmpty()) {
            return;
        }

        $owners->each(function ($owner) use ($packageDescriptions) {
            $statuses = [PackageStatus::EXPIRED, PackageStatus::ACTIVE, PackageStatus::INACTIVE];

            foreach ($statuses as $status) {
                $description = $packageDescriptions->random();

                $period = fake()->randomElement(['Month', 'Year']);

                $effectiveDate = ($status === PackageStatus::EXPIRED)
                    ? now()->subYear()
                    : now();

                $expiryDate = ($period === 'Month')
                    ? (clone $effectiveDate)->addMonth()
                    : (clone $effectiveDate)->addYear();

                $packagePrice = ($period === 'Month')
                    ? ($description->monthly_package_price ?? 1000)
                    : ($description->annual_package_price ?? 10000);

                $negotiatedPrice = rand(1, 5) === 1 ? ($packagePrice * 0.9) : null;

                $subscription = PackageSubscription::create([
                    'operator_id' => $owner->id,
                    'package_description_id' => $description->id,
                    'package_price' => $packagePrice,
                    'negotiated_price' => $negotiatedPrice ? (int) ceil($negotiatedPrice) : null,
                    'no_of_properties' => $description->properties,
                    'no_of_support_team' => $description->support_team,
                    'status' => $status,
                    'effective_date' => $effectiveDate,
                    'expiry_date' => $expiryDate,
                ]);

                $targetPrice = $subscription->negotiated_price ?? $subscription->package_price;

                $alreadyPaid = Payment::where('payable_id', $subscription->id)
                    ->where('payable_type', PackageSubscription::class)
                    ->sum('payment_amount');

                if ($alreadyPaid < $targetPrice) {
                    Payment::factory()
                        ->forSubscription()
                        ->create([
                            'payable_id' => $subscription->id,
                            'payment_amount' => $targetPrice - $alreadyPaid,
                        ]);
                }
            }
        });
    }
}
