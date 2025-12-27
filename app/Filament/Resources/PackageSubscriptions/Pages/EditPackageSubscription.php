<?php

namespace App\Filament\Resources\PackageSubscriptions\Pages;

use App\Filament\Resources\PackageSubscriptions\PackageSubscriptionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPackageSubscription extends EditRecord
{
    protected static string $resource = PackageSubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
