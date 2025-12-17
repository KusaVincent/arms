<?php

namespace App\Policies;

use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;
use OwenIt\Auditing\Models\Audit;

class AuditPolicy
{
    use HandlesAuthorization, HasGuardControl;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:Audit');
    }

    // Required by tapp/filament-auditing plugin
    public function audit(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:Audit');
    }

    // Required by tapp/filament-auditing plugin
    public function restoreAudit(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:Audit');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(AuthUser $authUser, Audit $audit): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:Audit');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(AuthUser $authUser): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(AuthUser $authUser, Audit $audit): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(AuthUser $authUser, Audit $audit): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(AuthUser $authUser, Audit $audit): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(AuthUser $authUser, Audit $audit): bool
    {
        return false;
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return false;
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return false;
    }

    public function replicate(AuthUser $authUser, Audit $audit): bool
    {
        return false;
    }

    public function reorder(AuthUser $authUser): bool
    {
        return false;
    }
}
