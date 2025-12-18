<?php

namespace Database\Seeders;

use App\Models\PackageDescription;
use App\Models\Payment;
use App\Models\SubscriptionPackage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubscriptionPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $packages = PackageDescription::all();

        $packages->each(function ($package) use ($users) {

            $count = rand(1, 3);

            for ($i = 0; $i < $count; $i++) {

                $payment = Payment::factory()->create();

                $effectiveDate = now()->subMonths(rand(0, 6));
                $expiryDate = (clone $effectiveDate)->addMonths(
                    max(1, $package->period_in_months)
                );

                SubscriptionPackage::create([
                    'user_id'                => $users->random()->id,
                    'payment_id'             => $payment->id,
                    'package_description_id' => $package->id,
                    'no_of_properties'       => rand(1, 10),
                    'no_of_support_team'     => rand(1, 5),
                    'status'                 => $package->status,
                    'effective_date'         => $effectiveDate,
                    'expiry_date'            => $expiryDate,
                ]);
            }
        });
    }
}
