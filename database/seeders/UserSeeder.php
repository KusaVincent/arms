<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'name' => 'Name',
            'password' => '12345678',
            'email' => 'dsd@gmail.com',
        ];
        User::create($user);
    }
}
