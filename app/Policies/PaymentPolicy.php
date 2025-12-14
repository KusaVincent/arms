<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Payment;
use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class PaymentPolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:Payment');
    }

    public function view(AuthUser $authUser, Payment $payment): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:Payment');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:Payment');
    }

    public function update(AuthUser $authUser, Payment $payment): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:Payment');
    }

    public function delete(AuthUser $authUser, Payment $payment): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:Payment');
    }

    public function restore(AuthUser $authUser, Payment $payment): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:Payment');
    }

    public function forceDelete(AuthUser $authUser, Payment $payment): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:Payment');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:Payment');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:Payment');
    }

    public function replicate(AuthUser $authUser, Payment $payment): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:Payment');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:Payment');
    }
}
