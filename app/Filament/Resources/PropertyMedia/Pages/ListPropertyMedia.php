<?php

namespace App\Filament\Resources\PropertyMedia\Pages;

use App\Filament\Resources\PropertyMedia\PropertyMediaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPropertyMedia extends ListRecords
{
    protected static string $resource = PropertyMediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
