<?php

namespace App\Filament\Resources\Properties\Pages;

use App\Filament\Resources\Properties\PropertyResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;
use Filament\Resources\Pages\CreateRecord;

class CreateProperty extends CreateRecordWithSanitization
{
    protected static string $resource = PropertyResource::class;
}
