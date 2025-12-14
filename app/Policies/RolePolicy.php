<?php

declare(strict_types=1);

namespace App\Policies;

use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:Role');
    }

    public function view(AuthUser $authUser, Role $role): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:Role');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:Role');
    }

    public function update(AuthUser $authUser, Role $role): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:Role');
    }

    public function delete(AuthUser $authUser, Role $role): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:Role');
    }

    public function restore(AuthUser $authUser, Role $role): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:Role');
    }

    public function forceDelete(AuthUser $authUser, Role $role): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:Role');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:Role');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:Role');
    }

    public function replicate(AuthUser $authUser, Role $role): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:Role');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:Role');
    }
}
