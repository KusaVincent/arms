<?php

namespace App\Filament\Resources\PropertyTypes\Pages;

use App\Filament\Resources\PropertyTypes\PropertyTypeResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;

class CreatePropertyType extends CreateRecordWithSanitization
{
    protected static string $resource = PropertyTypeResource::class;
}
