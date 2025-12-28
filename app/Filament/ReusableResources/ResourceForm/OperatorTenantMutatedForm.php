<?php

namespace App\Filament\ReusableResources\ResourceForm;

use App\Filament\Resources\Common\FilamentHelper;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;

class OperatorTenantMutatedForm
{
    public static function make(Schema $schema): Section
    {
        $operation = FilamentHelper::getOperation($schema);

        return Section::make('User Details')
            ->when(
                $operation === 'create',
                fn (Section $component) => $component->statePath('user'),
                fn (Section $component) => $component->relationship('user')
            )
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('first_name')->required(),
                        TextInput::make('middle_name'),
                        TextInput::make('last_name')->required(),
                    ])->columns(3),
                Section::make()
                    ->schema([
                        Select::make('roles')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->when(
                                $operation === 'create',
                                fn (Select $component) => $component
                                    ->options(Role::pluck('name', 'id'))
                                    ->hidden(),
                                fn (Select $component) => $component
                                    ->relationship('roles', 'name')
                            ),
                        TextInput::make('email')->email()->required(),
                        TextInput::make('phone_number')->tel()->required(),
                    ])->columns(3),
            ])
            ->saveRelationshipsUsing(null);
    }
}
