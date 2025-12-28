<?php

namespace App\Filament\ReusableResources\ResourceForm;

use Exception;
use Filament\Schemas\Schema;

class TenantForm
{
    /**
     * @throws Exception
     */
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                OperatorTenantMutatedForm::make($schema),
            ]);
    }
}
