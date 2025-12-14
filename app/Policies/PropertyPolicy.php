<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Property;
use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class PropertyPolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:Property');
    }

    public function view(AuthUser $authUser, Property $property): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:Property');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:Property');
    }

    public function update(AuthUser $authUser, Property $property): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:Property');
    }

    public function delete(AuthUser $authUser, Property $property): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:Property');
    }

    public function restore(AuthUser $authUser, Property $property): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:Property');
    }

    public function forceDelete(AuthUser $authUser, Property $property): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:Property');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:Property');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:Property');
    }

    public function replicate(AuthUser $authUser, Property $property): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:Property');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:Property');
    }
}
