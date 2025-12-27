<?php

namespace App\Observers;

use App\Models\Operator;

class OperatorObserver
{
    public function creating(Operator $operator): void
    {
        // If an owner_id is set, this is a support team member being added
        if ($operator->owner_id) {
            $owner = Operator::find($operator->owner_id);

            $subscription = $owner->activeSubscription();

            if (!$subscription) {
                throw new \Exception("The owner does not have an active subscription.");
            }

            $limit = $subscription->no_of_support_team;
            $currentCount = $owner->supportTeam()->count();

            if ($currentCount >= $limit) {
                throw new \Exception("Cannot add support member. Package limit of {$limit} reached.");
            }
        }
    }
}
