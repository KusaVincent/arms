<?php

namespace Database\Seeders;

use App\Models\PackageDescription;
use Illuminate\Database\Seeder;

class PackageDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PackageDescription::factory()->count(10)->create();
    }
}
