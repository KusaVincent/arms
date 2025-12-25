<?php

declare(strict_types=1);

namespace App\Policies;

use App\Traits\HasGuardControl;
use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Operator;
use Illuminate\Auth\Access\HandlesAuthorization;

class OperatorPolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:Operator');
    }

    public function view(AuthUser $authUser, Operator $operator): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:Operator');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:Operator');
    }

    public function update(AuthUser $authUser, Operator $operator): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:Operator');
    }

    public function delete(AuthUser $authUser, Operator $operator): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:Operator');
    }

    public function restore(AuthUser $authUser, Operator $operator): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:Operator');
    }

    public function forceDelete(AuthUser $authUser, Operator $operator): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:Operator');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:Operator');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:Operator');
    }

    public function replicate(AuthUser $authUser, Operator $operator): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:Operator');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:Operator');
    }

}
