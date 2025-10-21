<?php

namespace App\Filament\Pages\Tenancy;

use Filament\Pages\Tenancy\EditTenantProfile;
use Filament\Schemas\Schema;

class EditRelationship extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Client profile';
    }

    #[\Override]
    public function form(Schema $schema): Schema
    {
        return RelationshipProfile::form($schema);
    }
}
