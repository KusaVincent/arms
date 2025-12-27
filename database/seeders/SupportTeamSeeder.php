<?php

namespace Database\Seeders;

use App\Enums\PackageStatus;
use App\Models\Operator;
use App\Models\User;
use Illuminate\Database\Seeder;

class SupportTeamSeeder extends Seeder
{
    public function run(): void
    {
        $ownersWithSubs = Operator::whereNull('owner_id')
            ->whereHas('packageSubscriptions', function($q) {
                $q->where('status', PackageStatus::ACTIVE)->where('expiry_date', '>', now());
            })->get();

        foreach ($ownersWithSubs as $owner) {
            $subscription = $owner->activeSubscription();
            $limit = $subscription->no_of_support_team;

            for ($i = 0; $i < $limit; $i++) {
                Operator::factory()
                    ->support(fake()->randomElement(['Caretaker', 'Maintainer']))
                    ->create([
                        'owner_id' => $owner->id,
                        'user_id' => User::factory()->operator()->create()->id,
                    ]);
            }
        }
    }
}
