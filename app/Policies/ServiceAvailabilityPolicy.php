<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\ServiceAvailability;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class ServiceAvailabilityPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ServiceAvailability');
    }

    public function view(AuthUser $authUser, ServiceAvailability $serviceAvailability): bool
    {
        return $authUser->can('View:ServiceAvailability');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ServiceAvailability');
    }

    public function update(AuthUser $authUser, ServiceAvailability $serviceAvailability): bool
    {
        return $authUser->can('Update:ServiceAvailability');
    }

    public function delete(AuthUser $authUser, ServiceAvailability $serviceAvailability): bool
    {
        return $authUser->can('Delete:ServiceAvailability');
    }

    public function restore(AuthUser $authUser, ServiceAvailability $serviceAvailability): bool
    {
        return $authUser->can('Restore:ServiceAvailability');
    }

    public function forceDelete(AuthUser $authUser, ServiceAvailability $serviceAvailability): bool
    {
        return $authUser->can('ForceDelete:ServiceAvailability');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ServiceAvailability');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ServiceAvailability');
    }

    public function replicate(AuthUser $authUser, ServiceAvailability $serviceAvailability): bool
    {
        return $authUser->can('Replicate:ServiceAvailability');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ServiceAvailability');
    }
}
