<?php

namespace Database\Seeders;

use App\Actions\GetClientId;
use App\Models\User;
use App\Services\UserService;
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
        $userService = app(UserService::class);

        $userData = [
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => 'password',
        ];

        $superAdmin = User::create($userData);

        User::factory(2)->create()->each(function (User $user) use ($userService): void {
            $userService->assignDefaultRoleToUser($user);
        });

        $superAdmin->clients()->sync([
            GetClientId::query('Administrator'),
        ]);
    }
}
