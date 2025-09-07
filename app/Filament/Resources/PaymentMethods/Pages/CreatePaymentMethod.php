<?php

namespace App\Filament\Resources\PaymentMethods\Pages;

use App\Filament\Resources\PaymentMethods\PaymentMethodResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;
use Filament\Resources\Pages\CreateRecord;

class CreatePaymentMethod extends CreateRecordWithSanitization
{
    protected static string $resource = PaymentMethodResource::class;
}
