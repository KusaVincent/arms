<?php

namespace App\Traits;

use App\Filament\Resources\Abouts\AboutResource;
use App\Filament\Resources\Amenities\AmenityResource;
use App\Filament\Resources\Contacts\ContactResource;
use App\Filament\Resources\CustomerSupports\CustomerSupportResource;
use App\Filament\Resources\LeaseAgreements\LeaseAgreementResource;
use App\Filament\Resources\Locations\LocationResource;
use App\Filament\Resources\Maintenances\MaintenanceResource;
use App\Filament\Resources\Operators\OperatorResource;
use App\Filament\Resources\PackageDescriptions\PackageDescriptionResource;
use App\Filament\Resources\PackageSubscriptions\PackageSubscriptionResource;
use App\Filament\Resources\PaymentMethods\PaymentMethodResource;
use App\Filament\Resources\Payments\PaymentResource;
use App\Filament\Resources\Properties\PropertyResource;
use App\Filament\Resources\PropertyMedia\PropertyMediaResource;
use App\Filament\Resources\PropertyTypes\PropertyTypeResource;
use App\Filament\Resources\ServiceAvailabilities\ServiceAvailabilityResource;
use App\Filament\Resources\Tenants\TenantResource;
use App\Filament\Resources\Users\UserResource;
use Filament\Support\Icons\Heroicon;

trait HasSharedResourceProperties
{
    private static string $userResource = UserResource::class;
    private static string $aboutResource = AboutResource::class;
    private static string $tenantResource = TenantResource::class;
    private static string $contactResource = ContactResource::class;
    private static string $paymentResource = PaymentResource::class;
    private static string $amenityResource = AmenityResource::class;
    private static string $locationResource = LocationResource::class;
    private static string $operatorResource = OperatorResource::class;
    private static string $propertyResource = PropertyResource::class;
    private static string $maintenanceResource = MaintenanceResource::class;
    private static string $propertyTypeResource = PropertyTypeResource::class;
    private static string $propertyMediaResource = PropertyMediaResource::class;
    private static string $paymentMethodResource = PaymentMethodResource::class;
    private static string $leaseAgreementResource = LeaseAgreementResource::class;
    private static string $packageDescription = PackageDescriptionResource::class;
    private static string $packageSubscription = PackageSubscriptionResource::class;
    private static string $customerSupportResource = CustomerSupportResource::class;
    private static string $serviceAvailabilityResource = ServiceAvailabilityResource::class;


    public static function globalSearchResultsLimit(): int
    {
        return 20;
    }

    public static function getActiveNavigationIcon(): Heroicon
    {
        return Heroicon::OutlinedCheckBadge;
    }

    public static function getNavigationIcon(): Heroicon
    {
        return match(static::class) {
            static::$userResource => Heroicon::User,
            static::$locationResource => Heroicon::MapPin,
            static::$aboutResource => Heroicon::ArchiveBox,
            static::$amenityResource => Heroicon::ChartBar,
            static::$tenantResource => Heroicon::UserCircle,
            static::$customerSupportResource => Heroicon::Sun,
            static::$propertyMediaResource => Heroicon::Photo,
            static::$propertyResource => Heroicon::HomeModern,
            static::$operatorResource => Heroicon::OutlinedUser,
            static::$packageDescription => Heroicon::PhoneXMark,
            static::$paymentResource => Heroicon::CurrencyDollar,
            static::$leaseAgreementResource => Heroicon::Document,
            static::$packageSubscription => Heroicon::ShieldExclamation,
            static::$contactResource => Heroicon::DevicePhoneMobile,
            static::$propertyTypeResource => Heroicon::OutlinedHome,
            static::$maintenanceResource => Heroicon::DocumentArrowDown,
            static::$serviceAvailabilityResource => Heroicon::CircleStack,
            static::$paymentMethodResource => Heroicon::DocumentCurrencyDollar,

            default => Heroicon::OutlinedCheckBadge,
        };
    }

    public static function getGloballySearchableAttributes(): array
    {
        return match (static::class) {
            static::$aboutResource => ['title'],
            static::$locationResource => ['full_address'],
            static::$propertyTypeResource => ['type_name'],
            static::$maintenanceResource => ['description'],
            static::$propertyMediaResource => ['property.name'],
            static::$serviceAvailabilityResource => ['service_key'],
            static::$amenityResource => ['amenity_name', 'amenity_description'],
            static::$leaseAgreementResource => ['tenant.user.name', 'property.name'],
            static::$userResource => ['name', 'middle_name', 'email', 'phone_number'],
            static::$propertyResource => ['name', 'location.full_address', 'amenities.amenity_name', 'propertyType.type_name'],
            static::$operatorResource, static::$tenantResource => ['user.name', 'user.middle_name', 'user.email', 'user.phone_number'],

            default => ['id'],
        };
    }

    public static function getNavigationBadge(): ?string
    {
        return match (static::class) {
            static::$userResource => (string)static::usersWithoutRolesCount() ?: null,
            static::$customerSupportResource => (string)static::unrepliedCustomerSupportMessages() ?: null,
            default => null,
        };
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return match (static::class) {
            static::$userResource => static::usersWithoutRolesCount() > 5 ? 'danger' : 'warning',
            static::$customerSupportResource => static::unrepliedCustomerSupportMessages() > 5 ? 'danger' : 'warning',
            default => null,
        };
    }

    protected static function usersWithoutRolesCount(): int
    {
        static $count = null;

        if ($count === null) {
            $count = static::getModel()::doesntHave('roles')->count();
        }

        return $count;
    }

    protected static function unrepliedCustomerSupportMessages(): int
    {
        static $count = null;

        if ($count === null) {
            $count = static::getModel()::whereNull('reply')->count();
        }

        return $count;
    }
}
