<?php

namespace Database\Seeders;

use App\Models\PackageDescription;
use App\Models\Payment;
use App\Models\SubscriptionPackage;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubscriptionPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $packageDescriptions = PackageDescription::all();

        if ($users->isEmpty() || $packageDescriptions->isEmpty()) {
            return;
        }

        $packageDescriptions->each(function ($description) use ($users) {
            $count = rand(1, 3);

            for ($i = 0; $i < $count; $i++) {
                $effectiveDate = now()->subMonths(rand(0, 6));
                $expiryDate = (clone $effectiveDate)->addMonths(
                    max(1, $description->period_in_months)
                );

                $subscription = SubscriptionPackage::create([
                    'user_id' => $users->random()->id,
                    'package_description_id' => $description->id,
                    'no_of_properties' => rand(1, 10),
                    'no_of_support_team' => rand(1, 5),
                    'status' => $description->status,
                    'effective_date' => $effectiveDate,
                    'expiry_date' => $expiryDate,
                ]);

                Payment::factory()
                    ->forSubscription()
                    ->create([
                        'payable_id' => $subscription->id,
                        'payment_amount' => $description->price ?? rand(1000, 5000),
                    ]);
            }
        });
    }
}
