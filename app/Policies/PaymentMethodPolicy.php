<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\PaymentMethod;
use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class PaymentMethodPolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:PaymentMethod');
    }

    public function view(AuthUser $authUser, PaymentMethod $paymentMethod): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:PaymentMethod');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:PaymentMethod');
    }

    public function update(AuthUser $authUser, PaymentMethod $paymentMethod): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:PaymentMethod');
    }

    public function delete(AuthUser $authUser, PaymentMethod $paymentMethod): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:PaymentMethod');
    }

    public function restore(AuthUser $authUser, PaymentMethod $paymentMethod): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:PaymentMethod');
    }

    public function forceDelete(AuthUser $authUser, PaymentMethod $paymentMethod): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:PaymentMethod');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:PaymentMethod');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:PaymentMethod');
    }

    public function replicate(AuthUser $authUser, PaymentMethod $paymentMethod): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:PaymentMethod');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:PaymentMethod');
    }
}
