<?php

namespace App\Traits;

trait HasCustomSlug
{
    public function getRouteKeyName(): string
    {
        return 'mnemonic';
    }
}
