<?php

namespace App\Filament\ReusableResources\ResourceForm;

use App\Enums\ActiveServiceAvailability;
use Exception;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceAvailabilityForm
{
    /**
     * @throws Exception
     */
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('service_name')
                            ->required()
                            ->label('Service Name'),
                        Section::make()
                            ->description('This field is what is used by the system to check if service is active or not')
                            ->schema([
                                TextInput::make('service_key')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->label('Service Key'),
                            ]),
                        Select::make('is_active')
                            ->label('Active')
                            ->default(ActiveServiceAvailability::NO)
                            ->options(ActiveServiceAvailability::class),
                    ]),
            ]);
    }
}
