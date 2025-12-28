<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait HandleRecordCreation
{
    public string $userType;

    protected function handle(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $userData = $data['user'] ?? [];

            $user = User::create([
                'first_name' => $userData['first_name'],
                'middle_name' => $userData['middle_name'] ?? null,
                'last_name' => $userData['last_name'],
                'email' => $userData['email'],
                'phone_number' => $userData['phone_number'],
                'user_type' => $this->userType,
                'password' => Str::random(12),
                'name' => "{$userData['first_name']} {$userData['last_name']}",
            ]);

            if (! empty($userData['roles'])) {
                $user->roles()->sync($userData['roles']);
            }

            $attributes = [
                'user_id' => $user->id,
            ];

            if ($this->userType === 'operator') {
                $attributes['type'] = $data['type'];
            }

            return static::getModel()::create($attributes);
        });
    }
}
