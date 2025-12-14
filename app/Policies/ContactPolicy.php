<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Contact;
use App\Traits\HasGuardControl;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class ContactPolicy
{
    use HandlesAuthorization, HasGuardControl;

    public function viewAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ViewAny:Contact');
    }

    public function view(AuthUser $authUser, Contact $contact): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('View:Contact');
    }

    public function create(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Create:Contact');
    }

    public function update(AuthUser $authUser, Contact $contact): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Update:Contact');
    }

    public function delete(AuthUser $authUser, Contact $contact): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Delete:Contact');
    }

    public function restore(AuthUser $authUser, Contact $contact): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Restore:Contact');
    }

    public function forceDelete(AuthUser $authUser, Contact $contact): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDelete:Contact');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('ForceDeleteAny:Contact');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('RestoreAny:Contact');
    }

    public function replicate(AuthUser $authUser, Contact $contact): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Replicate:Contact');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return ! $this->isGuardEnabled() || $authUser->can('Reorder:Contact');
    }
}
