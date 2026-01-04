<?php

namespace App\Filament\Resources\Operators\Schemas;

use App\Filament\ReusableResources\Common\OperatorTenantMutatedForm;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OperatorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('type')
                        ->required(),
                    OperatorTenantMutatedForm::make($schema),
                ]),
            ]);
    }
}
