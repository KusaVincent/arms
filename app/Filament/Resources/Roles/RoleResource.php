<?php

namespace App\Filament\Resources\Roles;

use App\Models\Role;
use Filament\Resources\Resource;

class RoleResource extends Resource
{
    public static ?string $model = Role::class;

    public static string $title = 'Role';

    public static ?string $tenantOwnershipRelationshipName = 'clients';
}
