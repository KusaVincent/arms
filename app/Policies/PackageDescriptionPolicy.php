<?php

declare(strict_types=1);

namespace App\Policies;

use App\Traits\HasGuardControl;
use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PackageDescription;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackageDescriptionPolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:PackageDescription');
    }

    public function view(AuthUser $authUser, PackageDescription $packageDescription): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:PackageDescription');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:PackageDescription');
    }

    public function update(AuthUser $authUser, PackageDescription $packageDescription): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:PackageDescription');
    }

    public function delete(AuthUser $authUser, PackageDescription $packageDescription): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:PackageDescription');
    }

    public function restore(AuthUser $authUser, PackageDescription $packageDescription): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:PackageDescription');
    }

    public function forceDelete(AuthUser $authUser, PackageDescription $packageDescription): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:PackageDescription');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:PackageDescription');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:PackageDescription');
    }

    public function replicate(AuthUser $authUser, PackageDescription $packageDescription): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:PackageDescription');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:PackageDescription');
    }

}
