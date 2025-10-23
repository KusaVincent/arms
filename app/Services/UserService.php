<?php

namespace App\Services;

use App\Actions\GetClientId;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\PermissionRegistrar;

class UserService
{
    /**
     * Creates a new user with a default team role and client association.
     *
     * @param  array  $data
     *
     * @throws \Throwable
     */
    public function createWithDefaultRole(array $userData): User
    {
        return DB::transaction(fn (): ?\App\Models\User => $this->processUserRoleAssignment($userData, true));
    }

    /**
     * Assigns the default team role and client to a given user.
     */
    public function assignDefaultRoleToUser(User $user): void
    {
        $this->processUserRoleAssignment($user);
    }

    public function assignSuperAdminToUser(array $userData): void
    {
        $this->processUserRoleAssignment($userData, true, 'super_admin');
    }

    /**
     * Handles the core logic for assigning the default role and client.
     */
    private function processUserRoleAssignment(User|array $userOrData, bool $isNewUser = false, string $roleName = 'panel_user'): ?User
    {
        if (config('permission.teams')) {

            if ($roleName === 'super_admin') {
                $clientId = GetClientId::query('Administrator');
            } else {
                $clientId = GetClientId::query();
            }

            app(PermissionRegistrar::class)->setPermissionsTeamId($clientId);
        }

        $user = $userOrData;

        if ($isNewUser) {
            $userData = [
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
            ];

            $user = User::create($userData);
        }

        $user->assignRole($roleName);

        if (config('permission.teams')) {
            $user->clients()->syncWithoutDetaching([$clientId]);
            app(PermissionRegistrar::class)->setPermissionsTeamId(null);
        }

        return $isNewUser ? $user : null;
    }
}
