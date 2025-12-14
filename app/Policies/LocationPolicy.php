<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Location;
use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class LocationPolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:Location');
    }

    public function view(AuthUser $authUser, Location $location): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:Location');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:Location');
    }

    public function update(AuthUser $authUser, Location $location): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:Location');
    }

    public function delete(AuthUser $authUser, Location $location): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:Location');
    }

    public function restore(AuthUser $authUser, Location $location): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:Location');
    }

    public function forceDelete(AuthUser $authUser, Location $location): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:Location');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:Location');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:Location');
    }

    public function replicate(AuthUser $authUser, Location $location): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:Location');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:Location');
    }
}
