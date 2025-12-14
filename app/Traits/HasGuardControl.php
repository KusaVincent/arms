<?php

namespace App\Traits;

trait GuardControl
{
    protected function isGuardEnabled(): bool
    {
        return app()->isLocal() && (bool) config('app.guard_control');
    }
}
