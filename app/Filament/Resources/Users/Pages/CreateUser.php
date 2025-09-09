<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;

class CreateUser extends CreateRecordWithSanitization
{
    protected static string $resource = UserResource::class;
}
