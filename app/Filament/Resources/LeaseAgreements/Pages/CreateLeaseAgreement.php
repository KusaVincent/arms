<?php

namespace App\Filament\Resources\LeaseAgreements\Pages;

use App\Filament\Resources\LeaseAgreements\LeaseAgreementResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;

class CreateLeaseAgreement extends CreateRecordWithSanitization
{
    protected static string $resource = LeaseAgreementResource::class;
}
