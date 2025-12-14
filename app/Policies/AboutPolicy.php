<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\About;
use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class AboutPolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:About');
    }

    public function view(AuthUser $authUser, About $about): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:About');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:About');
    }

    public function update(AuthUser $authUser, About $about): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:About');
    }

    public function delete(AuthUser $authUser, About $about): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:About');
    }

    public function restore(AuthUser $authUser, About $about): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:About');
    }

    public function forceDelete(AuthUser $authUser, About $about): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:About');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:About');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:About');
    }

    public function replicate(AuthUser $authUser, About $about): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:About');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:About');
    }
}
