<?php

namespace App\Filament\Resources\Amenities\Pages;

use App\Filament\Resources\Amenities\AmenityResource;
use App\Filament\ReusableResources\EditRecordWithSanitization;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAmenity extends EditRecordWithSanitization
{
    protected static string $resource = AmenityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
