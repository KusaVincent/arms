<?php

declare(strict_types=1);

namespace App\Policies;

use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;
use Spatie\Activitylog\Models\Activity;

class ActivityPolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:Activity');
    }

    public function view(AuthUser $authUser, Activity $activity): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:Activity');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:Activity');
    }

    public function update(AuthUser $authUser, Activity $activity): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:Activity');
    }

    public function delete(AuthUser $authUser, Activity $activity): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:Activity');
    }

    public function restore(AuthUser $authUser, Activity $activity): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:Activity');
    }

    public function forceDelete(AuthUser $authUser, Activity $activity): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:Activity');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:Activity');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:Activity');
    }

    public function replicate(AuthUser $authUser, Activity $activity): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:Activity');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:Activity');
    }
}
