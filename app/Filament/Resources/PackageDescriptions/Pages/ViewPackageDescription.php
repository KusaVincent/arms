<?php

namespace App\Filament\Resources\PackageDescriptions\Pages;

use App\Filament\Resources\PackageDescriptions\PackageDescriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPackageDescription extends ViewRecord
{

    protected static string $resource = PackageDescriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
