<?php

namespace Database\Seeders;

use BezhanSalleh\FilamentShield\Support\Utils;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"panel_user","guard_name":"web","permissions":[]},{"name":"super_admin","guard_name":"web","permissions":["ViewAny:About","View:About","Create:About","Update:About","Delete:About","Restore:About","ForceDelete:About","ForceDeleteAny:About","RestoreAny:About","Replicate:About","Reorder:About","ViewAny:Amenity","View:Amenity","Create:Amenity","Update:Amenity","Delete:Amenity","Restore:Amenity","ForceDelete:Amenity","ForceDeleteAny:Amenity","RestoreAny:Amenity","Replicate:Amenity","Reorder:Amenity","ViewAny:Contact","View:Contact","Create:Contact","Update:Contact","Delete:Contact","Restore:Contact","ForceDelete:Contact","ForceDeleteAny:Contact","RestoreAny:Contact","Replicate:Contact","Reorder:Contact","ViewAny:CustomerSupport","View:CustomerSupport","Create:CustomerSupport","Update:CustomerSupport","Delete:CustomerSupport","Restore:CustomerSupport","ForceDelete:CustomerSupport","ForceDeleteAny:CustomerSupport","RestoreAny:CustomerSupport","Replicate:CustomerSupport","Reorder:CustomerSupport","ViewAny:LeaseAgreement","View:LeaseAgreement","Create:LeaseAgreement","Update:LeaseAgreement","Delete:LeaseAgreement","Restore:LeaseAgreement","ForceDelete:LeaseAgreement","ForceDeleteAny:LeaseAgreement","RestoreAny:LeaseAgreement","Replicate:LeaseAgreement","Reorder:LeaseAgreement","ViewAny:Location","View:Location","Create:Location","Update:Location","Delete:Location","Restore:Location","ForceDelete:Location","ForceDeleteAny:Location","RestoreAny:Location","Replicate:Location","Reorder:Location","ViewAny:Maintenance","View:Maintenance","Create:Maintenance","Update:Maintenance","Delete:Maintenance","Restore:Maintenance","ForceDelete:Maintenance","ForceDeleteAny:Maintenance","RestoreAny:Maintenance","Replicate:Maintenance","Reorder:Maintenance","ViewAny:PaymentMethod","View:PaymentMethod","Create:PaymentMethod","Update:PaymentMethod","Delete:PaymentMethod","Restore:PaymentMethod","ForceDelete:PaymentMethod","ForceDeleteAny:PaymentMethod","RestoreAny:PaymentMethod","Replicate:PaymentMethod","Reorder:PaymentMethod","ViewAny:Payment","View:Payment","Create:Payment","Update:Payment","Delete:Payment","Restore:Payment","ForceDelete:Payment","ForceDeleteAny:Payment","RestoreAny:Payment","Replicate:Payment","Reorder:Payment","ViewAny:Property","View:Property","Create:Property","Update:Property","Delete:Property","Restore:Property","ForceDelete:Property","ForceDeleteAny:Property","RestoreAny:Property","Replicate:Property","Reorder:Property","ViewAny:PropertyMedia","View:PropertyMedia","Create:PropertyMedia","Update:PropertyMedia","Delete:PropertyMedia","Restore:PropertyMedia","ForceDelete:PropertyMedia","ForceDeleteAny:PropertyMedia","RestoreAny:PropertyMedia","Replicate:PropertyMedia","Reorder:PropertyMedia","ViewAny:PropertyType","View:PropertyType","Create:PropertyType","Update:PropertyType","Delete:PropertyType","Restore:PropertyType","ForceDelete:PropertyType","ForceDeleteAny:PropertyType","RestoreAny:PropertyType","Replicate:PropertyType","Reorder:PropertyType","ViewAny:Role","View:Role","Create:Role","Update:Role","Delete:Role","Restore:Role","ForceDelete:Role","ForceDeleteAny:Role","RestoreAny:Role","Replicate:Role","Reorder:Role","ViewAny:ServiceAvailability","View:ServiceAvailability","Create:ServiceAvailability","Update:ServiceAvailability","Delete:ServiceAvailability","Restore:ServiceAvailability","ForceDelete:ServiceAvailability","ForceDeleteAny:ServiceAvailability","RestoreAny:ServiceAvailability","Replicate:ServiceAvailability","Reorder:ServiceAvailability","ViewAny:Tenant","View:Tenant","Create:Tenant","Update:Tenant","Delete:Tenant","Restore:Tenant","ForceDelete:Tenant","ForceDeleteAny:Tenant","RestoreAny:Tenant","Replicate:Tenant","Reorder:Tenant","ViewAny:User","View:User","Create:User","Update:User","Delete:User","Restore:User","ForceDelete:User","ForceDeleteAny:User","RestoreAny:User","Replicate:User","Reorder:User","ViewAny:AuthenticationLog","View:AuthenticationLog","Create:AuthenticationLog","Update:AuthenticationLog","Delete:AuthenticationLog","Restore:AuthenticationLog","ForceDelete:AuthenticationLog","ForceDeleteAny:AuthenticationLog","RestoreAny:AuthenticationLog","Replicate:AuthenticationLog","Reorder:AuthenticationLog"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
