<?php

declare(strict_types=1);

namespace App\Policies;

use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;
use Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog;

class AuthenticationLogPolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:AuthenticationLog');
    }

    public function view(AuthUser $authUser, AuthenticationLog $authenticationLog): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:AuthenticationLog');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:AuthenticationLog');
    }

    public function update(AuthUser $authUser, AuthenticationLog $authenticationLog): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:AuthenticationLog');
    }

    public function delete(AuthUser $authUser, AuthenticationLog $authenticationLog): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:AuthenticationLog');
    }

    public function restore(AuthUser $authUser, AuthenticationLog $authenticationLog): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:AuthenticationLog');
    }

    public function forceDelete(AuthUser $authUser, AuthenticationLog $authenticationLog): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:AuthenticationLog');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:AuthenticationLog');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:AuthenticationLog');
    }

    public function replicate(AuthUser $authUser, AuthenticationLog $authenticationLog): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:AuthenticationLog');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:AuthenticationLog');
    }
}
