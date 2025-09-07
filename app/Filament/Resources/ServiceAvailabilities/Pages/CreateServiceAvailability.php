<?php

namespace App\Filament\Resources\ServiceAvailabilities\Pages;

use App\Filament\Resources\ServiceAvailabilities\ServiceAvailabilityResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceAvailability extends CreateRecordWithSanitization
{
    protected static string $resource = ServiceAvailabilityResource::class;
}
