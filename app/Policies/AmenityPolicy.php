<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Amenity;
use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class AmenityPolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:Amenity');
    }

    public function view(AuthUser $authUser, Amenity $amenity): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:Amenity');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:Amenity');
    }

    public function update(AuthUser $authUser, Amenity $amenity): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:Amenity');
    }

    public function delete(AuthUser $authUser, Amenity $amenity): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:Amenity');
    }

    public function restore(AuthUser $authUser, Amenity $amenity): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:Amenity');
    }

    public function forceDelete(AuthUser $authUser, Amenity $amenity): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:Amenity');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:Amenity');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:Amenity');
    }

    public function replicate(AuthUser $authUser, Amenity $amenity): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:Amenity');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:Amenity');
    }
}
