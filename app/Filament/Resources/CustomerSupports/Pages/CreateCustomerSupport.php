<?php

namespace App\Filament\Resources\CustomerSupports\Pages;

use App\Filament\Resources\CustomerSupports\CustomerSupportResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;

class CreateCustomerSupport extends CreateRecordWithSanitization
{
    protected static string $resource = CustomerSupportResource::class;
}
