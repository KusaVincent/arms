<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\PropertyType;
use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class PropertyTypePolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:PropertyType');
    }

    public function view(AuthUser $authUser, PropertyType $propertyType): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:PropertyType');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:PropertyType');
    }

    public function update(AuthUser $authUser, PropertyType $propertyType): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:PropertyType');
    }

    public function delete(AuthUser $authUser, PropertyType $propertyType): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:PropertyType');
    }

    public function restore(AuthUser $authUser, PropertyType $propertyType): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:PropertyType');
    }

    public function forceDelete(AuthUser $authUser, PropertyType $propertyType): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:PropertyType');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:PropertyType');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:PropertyType');
    }

    public function replicate(AuthUser $authUser, PropertyType $propertyType): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:PropertyType');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:PropertyType');
    }
}
