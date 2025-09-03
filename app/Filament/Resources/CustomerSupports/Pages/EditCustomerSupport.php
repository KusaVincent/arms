<?php

namespace App\Filament\Resources\CustomerSupports\Pages;

use App\Filament\Resources\CustomerSupports\CustomerSupportResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCustomerSupport extends EditRecord
{
    protected static string $resource = CustomerSupportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
