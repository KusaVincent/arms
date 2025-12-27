<?php

namespace App\Filament\Resources\PackageSubscriptions\Pages;

use App\Filament\Resources\PackageSubscriptions\PackageSubscriptionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPackageSubscription extends ViewRecord
{
    protected static string $resource = PackageSubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
