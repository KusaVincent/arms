<?php

namespace App\Filament\Resources\Contacts\Pages;

use App\Filament\Resources\Contacts\ContactResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;

class CreateContact extends CreateRecordWithSanitization
{
    protected static string $resource = ContactResource::class;
}
