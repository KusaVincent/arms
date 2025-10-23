<?php

namespace App\Actions;

use App\Models\Client;

class GetClientId
{
    public static function query(string $name = 'Default'): int
    {
        return Client::firstOrCreate(['name' => $name])->id;
    }
}
