<?php

namespace App\Policies;

use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class UserPolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:User');
    }

    public function view(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:User');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:User');
    }

    public function update(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:User');
    }

    public function delete(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:User');
    }

    public function restore(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:User');
    }

    public function forceDelete(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:User');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:User');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:User');
    }

    public function replicate(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:User');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:User');
    }
}
