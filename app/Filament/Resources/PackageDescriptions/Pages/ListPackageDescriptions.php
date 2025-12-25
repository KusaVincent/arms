<?php

namespace App\Filament\Resources\PackageDescriptions\Pages;

use App\Filament\Resources\PackageDescriptions\PackageDescriptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPackageDescriptions extends ListRecords
{
    protected static string $resource = PackageDescriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
