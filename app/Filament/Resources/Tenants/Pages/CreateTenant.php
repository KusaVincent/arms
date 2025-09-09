<?php

namespace App\Filament\Resources\Tenants\Pages;

use App\Filament\Resources\Tenants\TenantResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;

class CreateTenant extends CreateRecordWithSanitization
{
    protected static string $resource = TenantResource::class;
}
