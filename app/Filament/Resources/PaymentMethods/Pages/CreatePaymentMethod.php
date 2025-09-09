<?php

namespace App\Filament\Resources\PaymentMethods\Pages;

use App\Filament\Resources\PaymentMethods\PaymentMethodResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;

class CreatePaymentMethod extends CreateRecordWithSanitization
{
    protected static string $resource = PaymentMethodResource::class;
}
