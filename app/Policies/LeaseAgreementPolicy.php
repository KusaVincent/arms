<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\LeaseAgreement;
use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class LeaseAgreementPolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:LeaseAgreement');
    }

    public function view(AuthUser $authUser, LeaseAgreement $leaseAgreement): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:LeaseAgreement');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:LeaseAgreement');
    }

    public function update(AuthUser $authUser, LeaseAgreement $leaseAgreement): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:LeaseAgreement');
    }

    public function delete(AuthUser $authUser, LeaseAgreement $leaseAgreement): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:LeaseAgreement');
    }

    public function restore(AuthUser $authUser, LeaseAgreement $leaseAgreement): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:LeaseAgreement');
    }

    public function forceDelete(AuthUser $authUser, LeaseAgreement $leaseAgreement): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:LeaseAgreement');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:LeaseAgreement');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:LeaseAgreement');
    }

    public function replicate(AuthUser $authUser, LeaseAgreement $leaseAgreement): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:LeaseAgreement');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:LeaseAgreement');
    }
}
