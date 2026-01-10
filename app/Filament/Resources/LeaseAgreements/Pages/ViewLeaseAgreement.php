<?php

namespace App\Filament\Resources\LeaseAgreements\Pages;

use App\Filament\Resources\LeaseAgreements\LeaseAgreementResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLeaseAgreement extends ViewRecord
{
    protected static string $resource = LeaseAgreementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
