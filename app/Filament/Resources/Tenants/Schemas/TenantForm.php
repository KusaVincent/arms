<?php

namespace App\Filament\Resources\Tenants\Schemas;

use App\Filament\ReusableResources\Common\OperatorTenantMutatedForm;
use Exception;
use Filament\Schemas\Schema;

class TenantForm
{
    /**
     * @throws Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                OperatorTenantMutatedForm::make($schema),
            ]);
    }
}
