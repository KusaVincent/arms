<?php

namespace App\Filament\Resources\Amenities\Pages;

use App\Filament\Resources\Amenities\AmenityResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;
use Filament\Resources\Pages\CreateRecord;

class CreateAmenity extends CreateRecordWithSanitization
{
    protected static string $resource = AmenityResource::class;
}
