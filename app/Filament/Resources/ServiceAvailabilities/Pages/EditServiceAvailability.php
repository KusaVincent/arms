<?php

namespace App\Filament\Resources\ServiceAvailabilities\Pages;

use App\Filament\Resources\ServiceAvailabilities\ServiceAvailabilityResource;
use App\Filament\ReusableResources\EditRecordWithSanitization;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditServiceAvailability extends EditRecordWithSanitization
{
    protected static string $resource = ServiceAvailabilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
