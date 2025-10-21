<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            ['name' => 'Default'],
            ['name' => 'Administrator'],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
