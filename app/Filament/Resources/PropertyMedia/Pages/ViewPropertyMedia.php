<?php

namespace App\Filament\Resources\PropertyMedia\Pages;

use App\Filament\Resources\PropertyMedia\PropertyMediaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPropertyMedia extends ViewRecord
{
    protected static string $resource = PropertyMediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
