<?php

namespace App\Traits;

use App\Filament\Resources\Abouts\AboutResource;
use App\Filament\Resources\Amenities\AmenityResource;
use App\Filament\Resources\LeaseAgreements\LeaseAgreementResource;
use App\Filament\Resources\Locations\LocationResource;
use App\Filament\Resources\Maintenances\MaintenanceResource;
use App\Filament\Resources\Operators\OperatorResource;
use App\Filament\Resources\Properties\PropertyResource;
use App\Filament\Resources\PropertyMedia\PropertyMediaResource;
use App\Filament\Resources\PropertyTypes\PropertyTypeResource;
use App\Filament\Resources\ServiceAvailabilities\ServiceAvailabilityResource;
use App\Filament\Resources\Tenants\TenantResource;
use App\Filament\Resources\Users\UserResource;
use Filament\Support\Icons\Heroicon;

trait HasSharedResourceProperties
{
    public static function globalSearchResultsLimit(): int
    {
        return 20;
    }

    public static function getActiveNavigationIcon(): Heroicon
    {
        return Heroicon::OutlinedCheckBadge;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return match (static::class) {
            AboutResource::class => ['title'],
            LocationResource::class => ['full_address'],
            PropertyTypeResource::class => ['type_name'],
            MaintenanceResource::class => ['description'],
            PropertyMediaResource::class => ['property.name'],
            ServiceAvailabilityResource::class => ['service_key'],
            AmenityResource::class => ['amenity_name', 'amenity_description'],
            LeaseAgreementResource::class => ['tenant.user.name', 'property.name'],
            UserResource::class => ['name', 'middle_name', 'email', 'phone_number'],
            PropertyResource::class => ['name', 'location.full_address', 'amenities.amenity_name', 'propertyType.name', ],
            OperatorResource::class, TenantResource::class => ['user.name', 'user.middle_name', 'user.email', 'user.phone_number'],

            default => ['id'],
        };
    }
}
