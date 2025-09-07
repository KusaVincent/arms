<?php

namespace App\Filament\Resources\PropertyTypes\Pages;

use App\Filament\Resources\PropertyTypes\PropertyTypeResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;
use Filament\Resources\Pages\CreateRecord;

class CreatePropertyType extends CreateRecordWithSanitization
{
    protected static string $resource = PropertyTypeResource::class;
}
