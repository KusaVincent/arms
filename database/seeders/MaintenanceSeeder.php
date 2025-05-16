<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Maintenance;
use Illuminate\Database\Seeder;

final class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Maintenance::factory(10)->create();
    }
}
