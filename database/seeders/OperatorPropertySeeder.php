<?php

namespace Database\Seeders;

use App\Models\Operator;
use App\Models\Property;
use App\Models\OperatorProperty;
use App\Models\User;
use Illuminate\Database\Seeder;

class OperatorPropertySeeder extends Seeder
{
    public function run(): void
    {
        $eligibleUsers = Operator::whereNot('type', 'Owner')->pluck('id');

        Property::all()->each(function ($property) use ($eligibleUsers) {
            $this->assignUsersToProperty($property, $eligibleUsers);
        });
    }

    private function assignUsersToProperty($property, $eligibleUsers): void
    {
        $ownerId = Operator::where('type', 'Owner')->pluck('id')->random();

        OperatorProperty::firstOrCreate(
            [
                'property_id' => $property->id,
                'operator_id' => $ownerId,
            ],
            [
                'relationship' => 'owner',
                'created_by' => $this->randomUserExcluding($eligibleUsers, [$ownerId]),
            ]
        );

        $ownerUserCount = OperatorProperty::where('operator_id', $ownerId)->count();
        $maxUsers = max(1, $ownerUserCount);

        $remainingUsers = $eligibleUsers->filter(fn ($id) => $id !== $ownerId);

        if ($remainingUsers->isEmpty()) {
            return;
        }

        // Random number of additional users, max capped by $maxUsers
        $count = fake()->numberBetween(1, min($maxUsers, $remainingUsers->count()));

        $remainingUsers->random($count)
            ->each(function ($operatorId) use ($property, $eligibleUsers) {
                OperatorProperty::firstOrCreate(
                    [
                        'property_id' => $property->id,
                        'operator_id' => $operatorId,
                    ],
                    [
                        'relationship' => 'operator',
                        'created_by' => $this->randomUserExcluding($eligibleUsers, [$operatorId]),
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
