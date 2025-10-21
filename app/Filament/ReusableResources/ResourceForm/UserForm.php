<?php

namespace App\Filament\ReusableResources\ResourceForm;

use Exception;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class UserForm
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
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                        Select::make('roles')
                            ->relationship('roles', 'name')
                            ->saveRelationshipsUsing(function (Model $record, $state): void {
                                $record->roles()->syncWithPivotValues($state, [config('permission.column_names.team_foreign_key') => getPermissionsTeamId()]);
                            })
                            ->multiple()
                            ->preload()
                            ->searchable(),
                        TextInput::make('password')
                            ->password()
                            ->required()
                            ->confirmed()
                            ->visible(fn ($livewire): bool => $livewire instanceof CreateRecord),
                        TextInput::make('password_confirmation')
                            ->password()
                            ->required()
                            ->dehydrated(false)
                            ->visible(fn ($livewire): bool => $livewire instanceof CreateRecord),
                    ])->columns(),
            ]);
    }
}
