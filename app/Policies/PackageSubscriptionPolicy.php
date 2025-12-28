<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\PackageSubscription;
use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class PackageSubscriptionPolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:PackageSubscription');
    }

    public function view(AuthUser $authUser, PackageSubscription $packageSubscription): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:PackageSubscription');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:PackageSubscription');
    }

    public function update(AuthUser $authUser, PackageSubscription $packageSubscription): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:PackageSubscription');
    }

    public function delete(AuthUser $authUser, PackageSubscription $packageSubscription): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:PackageSubscription');
    }

    public function restore(AuthUser $authUser, PackageSubscription $packageSubscription): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:PackageSubscription');
    }

    public function forceDelete(AuthUser $authUser, PackageSubscription $packageSubscription): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:PackageSubscription');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:PackageSubscription');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:PackageSubscription');
    }

    public function replicate(AuthUser $authUser, PackageSubscription $packageSubscription): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:PackageSubscription');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:PackageSubscription');
    }
}
