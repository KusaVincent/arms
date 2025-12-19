<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class PropertyUserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::where('email', 'superadmin@example.com')->first();

        $eligibleUsers = User::where('id', '!=', $superAdmin->id)->pluck('id');

        Property::all()->each(function ($property) use ($eligibleUsers) {
            $this->assignUsersToProperty($property, $eligibleUsers);
        });
    }

    private function assignUsersToProperty($property, $eligibleUsers): void
    {
        $ownerId = $eligibleUsers->random();

        PropertyUser::firstOrCreate(
            [
                'property_id' => $property->id,
                'user_id' => $ownerId,
            ],
            [
                'relationship' => 'owner',
                'created_by' => $this->randomUserExcluding($eligibleUsers, [$ownerId]),
            ]
        );

        $ownerUserCount = PropertyUser::where('user_id', $ownerId)->count();
        $maxUsers = max(1, $ownerUserCount);

        $remainingUsers = $eligibleUsers->filter(fn ($id) => $id !== $ownerId);

        if ($remainingUsers->isEmpty()) {
            return;
        }

        // Random number of additional users, max capped by $maxUsers
        $count = fake()->numberBetween(1, min($maxUsers, $remainingUsers->count()));

        $remainingUsers->random($count)
            ->each(function ($userId) use ($property, $eligibleUsers) {
                PropertyUser::firstOrCreate(
                    [
                        'property_id' => $property->id,
                        'user_id' => $userId,
                    ],
                    [
                        'relationship' => 'user',
                        'created_by' => $this->randomUserExcluding($eligibleUsers, [$userId]),
                    ]
                );
            });
    }

    private function randomUserExcluding($eligibleUsers, array $exclude = []): int
    {
        $filtered = $eligibleUsers->filter(fn ($id) => ! in_array($id, $exclude));

        return $filtered->random();
    }
}
