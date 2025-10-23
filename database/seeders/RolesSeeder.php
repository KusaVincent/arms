<?php

namespace Database\Seeders;

use App\Actions\GetClientId;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'panel_user',
                'guard_name' => 'web',
                ...(config('permission.teams') ? [
                    'client_id' => GetClientId::query(),
                ] : []),
            ],
            [
                'name' => 'super_admin',
                'guard_name' => 'web',
                ...(config('permission.teams') ? [
                    'client_id' => GetClientId::query('Administrator'),
                ] : []),
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate($role);
        }
    }
}
