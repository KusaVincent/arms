<?php

namespace App\Filament\Resources\Tenants\Pages;

use App\Filament\Resources\Tenants\TenantResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;
use App\Traits\HandleRecordCreation;
use Illuminate\Database\Eloquent\Model;

class CreateTenant extends CreateRecordWithSanitization
{
    use HandleRecordCreation;

    protected static string $resource = TenantResource::class;

    public function handleRecordCreation(array $data): Model
    {
        $this->userType = 'tenant';

        return $this->handle($data);
    }
}
