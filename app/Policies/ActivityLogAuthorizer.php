<?php

namespace App\Policies;

use App\Models\User;

class ActivityLogAuthorizer
{
    public function __invoke(User $user): bool
    {
        return $user->hasPermissionTo('ViewAny:Activity');
    }
}
