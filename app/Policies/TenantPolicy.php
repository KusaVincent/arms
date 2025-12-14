<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Tenant;
use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class TenantPolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:Tenant');
    }

    public function view(AuthUser $authUser, Tenant $tenant): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:Tenant');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:Tenant');
    }

    public function update(AuthUser $authUser, Tenant $tenant): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:Tenant');
    }

    public function delete(AuthUser $authUser, Tenant $tenant): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:Tenant');
    }

    public function restore(AuthUser $authUser, Tenant $tenant): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:Tenant');
    }

    public function forceDelete(AuthUser $authUser, Tenant $tenant): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:Tenant');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:Tenant');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:Tenant');
    }

    public function replicate(AuthUser $authUser, Tenant $tenant): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:Tenant');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:Tenant');
    }
}
