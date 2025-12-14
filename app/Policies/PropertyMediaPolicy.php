<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\PropertyMedia;
use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class PropertyMediaPolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:PropertyMedia');
    }

    public function view(AuthUser $authUser, PropertyMedia $propertyMedia): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:PropertyMedia');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:PropertyMedia');
    }

    public function update(AuthUser $authUser, PropertyMedia $propertyMedia): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:PropertyMedia');
    }

    public function delete(AuthUser $authUser, PropertyMedia $propertyMedia): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:PropertyMedia');
    }

    public function restore(AuthUser $authUser, PropertyMedia $propertyMedia): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:PropertyMedia');
    }

    public function forceDelete(AuthUser $authUser, PropertyMedia $propertyMedia): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:PropertyMedia');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:PropertyMedia');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:PropertyMedia');
    }

    public function replicate(AuthUser $authUser, PropertyMedia $propertyMedia): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:PropertyMedia');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:PropertyMedia');
    }
}
