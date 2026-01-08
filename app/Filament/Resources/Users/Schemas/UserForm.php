<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Filament\ReusableResources\Common\SelectField;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(3)
                    ->schema([
                        Group::make([
                            Section::make('Personal Information')
                                ->icon('heroicon-m-user')
                                ->schema([
                                    TextInput::make('first_name')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('middle_name')
                                        ->maxLength(255),
                                    TextInput::make('last_name')
                                        ->required()
                                        ->maxLength(255),
                                ])->columns(3),

                            Section::make('Contact Details')
                                ->icon('heroicon-m-envelope')
                                ->schema([
                                    TextInput::make('email')
                                        ->email()
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->prefixIcon('heroicon-m-at-symbol'),
                                    TextInput::make('phone_number')
                                        ->tel()
                                        ->required()
                                        ->prefixIcon('heroicon-m-phone'),
                                ])->columns(2),
                        ])->columnSpan(2),

                        Group::make([
                            Section::make('Access Control')
                                ->schema([
                                    SelectField::make('roles')
                                        ->relationship('roles', 'name')
                                        ->multiple()
                                        ->preload()
                                        ->searchable()
                                        ->getOptionLabelFromRecordUsing(fn ($record) => ucwords(str_replace('_', ' ', $record->name)))
                                        ->required(),
                                ]),

                            Section::make('Security')
                                ->description('Set a secure password for this account.')
                                ->visible(fn ($livewire) => $livewire instanceof CreateRecord)
                                ->schema([
                                    TextInput::make('password')
                                        ->password()
                                        ->required()
                                        ->confirmed()
                                        ->revealable(),
                                    TextInput::make('password_confirmation')
                                        ->password()
                                        ->required()
                                        ->dehydrated(false)
                                        ->revealable(),
                                ]),
                        ])->columnSpan(1),
                    ])->columnSpanFull(),
            ]);
    }
}
