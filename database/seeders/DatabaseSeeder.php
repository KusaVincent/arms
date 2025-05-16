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
            FounderSeeder::class,
            ContactSeeder::class,
            AmenitySeeder::class,
        ]);

        if (! app()->isProduction()) {
            $this->call([
                PropertyTypeSeeder::class,
                LocationSeeder::class,
                PropertySeeder::class,
                TenantSeeder::class,
                PropertyMediaSeeder::class,
                LeaseAgreementSeeder::class,
                MaintenanceSeeder::class,
                PropertyAmenitySeeder::class,
                ServiceAvailabilitySeeder::class,
            ]);
        }
    }
}
