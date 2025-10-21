<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultClientId = Client::firstOrCreate(['name' => 'Default'])->id;

        Role::firstOrCreate([
            'name' => 'panel_user',
            'guard_name' => 'web',
            ...(config('permission.teams') ? ['client_id' => $defaultClientId] : []),
        ]);

        // Now you can create users freely (booted() will handle roles)
        User::factory(2)->create();
    }
}
