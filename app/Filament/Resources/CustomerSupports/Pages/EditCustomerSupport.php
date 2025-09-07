<?php

namespace App\Filament\Resources\CustomerSupports\Pages;

use App\Filament\Resources\CustomerSupports\CustomerSupportResource;
use App\Filament\ReusableResources\EditRecordWithSanitization;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCustomerSupport extends EditRecordWithSanitization
{
    protected static string $resource = CustomerSupportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
