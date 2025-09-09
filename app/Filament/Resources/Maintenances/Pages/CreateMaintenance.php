<?php

namespace App\Filament\Resources\Maintenances\Pages;

use App\Filament\Resources\Maintenances\MaintenanceResource;
use App\Filament\ReusableResources\CreateRecordWithSanitization;

class CreateMaintenance extends CreateRecordWithSanitization
{
    protected static string $resource = MaintenanceResource::class;
}
