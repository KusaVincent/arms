<?php

namespace App\Filament\Resources\PackageSubscriptions\Pages;

use App\Filament\Resources\PackageSubscriptions\PackageSubscriptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPackageSubscriptions extends ListRecords
{
    protected static string $resource = PackageSubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
