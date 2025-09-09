<?php

namespace App\Filament\Resources\Locations\Pages;

use App\Filament\Resources\Locations\LocationResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;

class CreateLocation extends CreateRecordWithSanitization
{
    protected static string $resource = LocationResource::class;
}
