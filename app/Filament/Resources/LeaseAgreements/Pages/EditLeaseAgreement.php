<?php

namespace App\Filament\Resources\LeaseAgreements\Pages;

use App\Filament\Resources\LeaseAgreements\LeaseAgreementResource;
use App\Filament\ReusableResources\EditRecordWithSanitization;
use Filament\Actions\DeleteAction;

class EditLeaseAgreement extends EditRecordWithSanitization
{
    protected static string $resource = LeaseAgreementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
