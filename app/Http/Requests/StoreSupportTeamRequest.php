<?php

namespace App\Http\Requests;

use App\Models\Operator;

class StoreSupportTeamRequest
{
    public function authorize(): bool
    {
        $owner = auth()->user();

        $subscription = $owner->activeSubscription;

        if (! $subscription) {
            return false;
        }

        $currentSupportCount = Operator::where('owner_id', $owner->id)->count();

        return $currentSupportCount < $subscription->no_of_support_team;
    }

    public function messages(): array
    {
        return [
            'authorize' => 'You have reached the maximum number of support team members allowed by your current package.',
        ];
    }
}
