<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws \Throwable
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => '12345678',
            ]
        );

        User::factory()
            ->count(20)
            ->create([
                'password' => '12345678',
            ]);
    }
}
