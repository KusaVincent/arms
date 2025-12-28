<?php

namespace App\Filament\Resources\PackageDescriptions\Pages;

use App\Filament\Resources\PackageDescriptions\PackageDescriptionResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;

class CreatePackageDescription extends CreateRecordWithSanitization
{
    protected static string $resource = PackageDescriptionResource::class;
}
