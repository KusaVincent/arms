<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AboutSeeder::class,
            ShieldSeeder::class,
            FounderSeeder::class,
            ContactSeeder::class,
            AmenitySeeder::class,
            PaymentMethodSeeder::class,
        ]);

        if (! app()->isProduction()) {
            $this->call([
                UserSeeder::class,
                PropertyTypeSeeder::class,
                LocationSeeder::class,
                PropertySeeder::class,
                TenantSeeder::class,
                OperatorSeeder::class,
                PropertyMediaSeeder::class,
                LeaseAgreementSeeder::class,
                MaintenanceSeeder::class,
                PackageDescriptionSeeder::class,
                PackageSubscriptionSeeder::class,
                SupportTeamSeeder::class,
                OperatorPropertySeeder::class,
                AmenityPropertySeeder::class,
                ServiceAvailabilitySeeder::class,
            ]);
        }
    }
}
