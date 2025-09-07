<?php

namespace App\Filament\Resources\PropertyMedia\Pages;

use App\Filament\Resources\PropertyMedia\PropertyMediaResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;
use Filament\Resources\Pages\CreateRecord;

class CreatePropertyMedia extends CreateRecordWithSanitization
{
    protected static string $resource = PropertyMediaResource::class;
}
