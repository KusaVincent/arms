<?php

declare(strict_types=1);

namespace App\Policies;

use App\Traits\HasGuardControl;
use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SubscriptionPackage;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriptionPackagePolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:SubscriptionPackage');
    }

    public function view(AuthUser $authUser, SubscriptionPackage $subscriptionPackage): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:SubscriptionPackage');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:SubscriptionPackage');
    }

    public function update(AuthUser $authUser, SubscriptionPackage $subscriptionPackage): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:SubscriptionPackage');
    }

    public function delete(AuthUser $authUser, SubscriptionPackage $subscriptionPackage): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:SubscriptionPackage');
    }

    public function restore(AuthUser $authUser, SubscriptionPackage $subscriptionPackage): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:SubscriptionPackage');
    }

    public function forceDelete(AuthUser $authUser, SubscriptionPackage $subscriptionPackage): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:SubscriptionPackage');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:SubscriptionPackage');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:SubscriptionPackage');
    }

    public function replicate(AuthUser $authUser, SubscriptionPackage $subscriptionPackage): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:SubscriptionPackage');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:SubscriptionPackage');
    }

}
