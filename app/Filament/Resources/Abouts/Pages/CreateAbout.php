<?php

namespace App\Filament\Resources\Abouts\Pages;

use App\Filament\Resources\Abouts\AboutResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;
use App\Traits\HasSanitizedFormData;

class CreateAbout extends CreateRecordWithSanitization
{
    use HasSanitizedFormData;

    protected static string $resource = AboutResource::class;
}
