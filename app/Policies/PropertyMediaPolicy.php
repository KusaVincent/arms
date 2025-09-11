<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PropertyMedia;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyMediaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PropertyMedia');
    }

    public function view(AuthUser $authUser, PropertyMedia $propertyMedia): bool
    {
        return $authUser->can('View:PropertyMedia');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PropertyMedia');
    }

    public function update(AuthUser $authUser, PropertyMedia $propertyMedia): bool
    {
        return $authUser->can('Update:PropertyMedia');
    }

    public function delete(AuthUser $authUser, PropertyMedia $propertyMedia): bool
    {
        return $authUser->can('Delete:PropertyMedia');
    }

    public function restore(AuthUser $authUser, PropertyMedia $propertyMedia): bool
    {
        return $authUser->can('Restore:PropertyMedia');
    }

    public function forceDelete(AuthUser $authUser, PropertyMedia $propertyMedia): bool
    {
        return $authUser->can('ForceDelete:PropertyMedia');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PropertyMedia');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PropertyMedia');
    }

    public function replicate(AuthUser $authUser, PropertyMedia $propertyMedia): bool
    {
        return $authUser->can('Replicate:PropertyMedia');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PropertyMedia');
    }

}