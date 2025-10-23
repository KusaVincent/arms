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
            ClientSeeder::class,
            RolesSeeder::class,
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
                PropertyMediaSeeder::class,
                LeaseAgreementSeeder::class,
                MaintenanceSeeder::class,
                AmenityPropertySeeder::class,
                ServiceAvailabilitySeeder::class,
            ]);
        }
    }
}
