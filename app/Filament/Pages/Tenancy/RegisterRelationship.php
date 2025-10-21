<?php

namespace App\Filament\Pages\Tenancy;

use App\Models\Client;
use Filament\Pages\Tenancy\RegisterTenant;
use Filament\Schemas\Schema;

class RegisterRelationship extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register Relationship';
    }

    #[\Override]
    public function form(Schema $schema): Schema
    {
        return RelationshipProfile::form($schema);
    }

    #[\Override]
    protected function handleRegistration(array $data): Client
    {
        $relationship = Client::create($data);

        $relationship->users()->attach(auth()->user());

        return $relationship;
    }
}
