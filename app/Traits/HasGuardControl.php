<?php

namespace App\Traits;

trait HasGuardControl
{
    protected function isGuardEnabled(): bool
    {
        return app()->isLocal() && (bool) config('app.guard_control');
    }
}
