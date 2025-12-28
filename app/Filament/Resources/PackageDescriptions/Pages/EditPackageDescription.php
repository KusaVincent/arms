<?php

namespace App\Filament\Resources\PackageDescriptions\Pages;

use App\Filament\Resources\PackageDescriptions\PackageDescriptionResource;
use App\Filament\ReusableResources\EditRecordWithSanitization;
use Filament\Actions\DeleteAction;

class EditPackageDescription extends EditRecordWithSanitization
{
    protected static string $resource = PackageDescriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
