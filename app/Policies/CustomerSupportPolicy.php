<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\CustomerSupport;
use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class CustomerSupportPolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:CustomerSupport');
    }

    public function view(AuthUser $authUser, CustomerSupport $customerSupport): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:CustomerSupport');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:CustomerSupport');
    }

    public function update(AuthUser $authUser, CustomerSupport $customerSupport): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:CustomerSupport');
    }

    public function delete(AuthUser $authUser, CustomerSupport $customerSupport): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:CustomerSupport');
    }

    public function restore(AuthUser $authUser, CustomerSupport $customerSupport): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:CustomerSupport');
    }

    public function forceDelete(AuthUser $authUser, CustomerSupport $customerSupport): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:CustomerSupport');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:CustomerSupport');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:CustomerSupport');
    }

    public function replicate(AuthUser $authUser, CustomerSupport $customerSupport): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:CustomerSupport');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:CustomerSupport');
    }
}
