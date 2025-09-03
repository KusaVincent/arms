<?php

namespace App\Filament\Resources\PropertyMedia\Pages;

use App\Filament\Resources\PropertyMedia\PropertyMediaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPropertyMedia extends EditRecord
{
    protected static string $resource = PropertyMediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
