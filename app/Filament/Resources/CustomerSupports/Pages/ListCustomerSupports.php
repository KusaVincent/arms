<?php

namespace App\Filament\Resources\CustomerSupports\Pages;

use App\Filament\Resources\CustomerSupports\CustomerSupportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCustomerSupports extends ListRecords
{
    protected static string $resource = CustomerSupportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
