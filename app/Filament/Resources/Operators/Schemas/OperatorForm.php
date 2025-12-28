<?php

namespace App\Filament\Resources\Operators\Schemas;

use App\Filament\ReusableResources\ResourceForm\OperatorTenantMutatedForm;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OperatorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('type')
                    ->required(),
                OperatorTenantMutatedForm::make($schema),
            ]);
    }
}
