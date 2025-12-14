<?php

namespace App\Filament\Resources\Abouts\Pages;

use App\Filament\Resources\Abouts\AboutResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;

class CreateAbout extends CreateRecordWithSanitization
{
    protected static string $resource = AboutResource::class;
}
