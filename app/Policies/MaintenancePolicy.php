<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Maintenance;
use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class MaintenancePolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:Maintenance');
    }

    public function view(AuthUser $authUser, Maintenance $maintenance): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:Maintenance');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:Maintenance');
    }

    public function update(AuthUser $authUser, Maintenance $maintenance): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:Maintenance');
    }

    public function delete(AuthUser $authUser, Maintenance $maintenance): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:Maintenance');
    }

    public function restore(AuthUser $authUser, Maintenance $maintenance): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:Maintenance');
    }

    public function forceDelete(AuthUser $authUser, Maintenance $maintenance): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:Maintenance');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:Maintenance');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:Maintenance');
    }

    public function replicate(AuthUser $authUser, Maintenance $maintenance): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:Maintenance');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:Maintenance');
    }
}
