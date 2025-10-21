<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\CustomerSupport;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class CustomerSupportPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CustomerSupport');
    }

    public function view(AuthUser $authUser, CustomerSupport $customerSupport): bool
    {
        return $authUser->can('View:CustomerSupport');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CustomerSupport');
    }

    public function update(AuthUser $authUser, CustomerSupport $customerSupport): bool
    {
        return $authUser->can('Update:CustomerSupport');
    }

    public function delete(AuthUser $authUser, CustomerSupport $customerSupport): bool
    {
        return $authUser->can('Delete:CustomerSupport');
    }

    public function restore(AuthUser $authUser, CustomerSupport $customerSupport): bool
    {
        return $authUser->can('Restore:CustomerSupport');
    }

    public function forceDelete(AuthUser $authUser, CustomerSupport $customerSupport): bool
    {
        return $authUser->can('ForceDelete:CustomerSupport');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CustomerSupport');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CustomerSupport');
    }

    public function replicate(AuthUser $authUser, CustomerSupport $customerSupport): bool
    {
        return $authUser->can('Replicate:CustomerSupport');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CustomerSupport');
    }
}
