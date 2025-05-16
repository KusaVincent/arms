<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ServiceAvailability;
use Illuminate\Database\Seeder;

final class ServiceAvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceAvailabilities = [
            [
                'service_key' => 'meet_the_team',
                'is_active' => false,
                'service_name' => 'Founder Module',
            ],
            [
                'service_key' => 'starts',
                'is_active' => true,
                'service_name' => 'company starts',
            ],
        ];

        foreach ($serviceAvailabilities as $serviceAvailability) {
            ServiceAvailability::create($serviceAvailability);
        }
    }
}
