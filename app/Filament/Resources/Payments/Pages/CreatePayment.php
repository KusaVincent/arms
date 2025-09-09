<?php

namespace App\Filament\Resources\Payments\Pages;

use App\Filament\Resources\Payments\PaymentResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;

class CreatePayment extends CreateRecordWithSanitization
{
    protected static string $resource = PaymentResource::class;
}
