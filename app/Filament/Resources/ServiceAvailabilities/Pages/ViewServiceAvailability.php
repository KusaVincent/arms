<?php

namespace App\Filament\Resources\ServiceAvailabilities\Pages;

use App\Filament\Resources\ServiceAvailabilities\ServiceAvailabilityResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
class ViewServiceAvailability extends ViewRecord
{

    protected static string $resource = ServiceAvailabilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
