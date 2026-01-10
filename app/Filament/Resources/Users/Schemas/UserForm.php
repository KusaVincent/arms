<?php
namespace App\Filament\Resources\Users\Schemas;

use App\Filament\ReusableResources\Common\SelectField;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Details')
                    ->columns(2)
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('first_name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('middle_name')
                                ->maxLength(255),
                            TextInput::make('last_name')
                                ->required()
                                ->maxLength(255),
                        ]),

                        Grid::make(2)->schema([
                            TextInput::make('email')
                                ->email()
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->prefixIcon('heroicon-m-at-symbol'),
                            TextInput::make('phone_number')
                                ->tel()
                                ->required()
                                ->prefixIcon('heroicon-m-phone'),
                        ]),

                        SelectField::make('roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->getOptionLabelFromRecordUsing(fn ($record) => ucwords(str_replace('_', ' ', $record->name)))
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Security')
                    ->description('Set a secure password for this account.')
                    // Only show this section when creating a new user
                    ->visible(fn ($livewire) => $livewire instanceof CreateRecord)
                    ->columns(2)
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

                Section::make('Audit Information')
                    ->columns(2)
                    ->schema([
                        DateTimePicker::make('created_at')
                            ->label('Created At')
                            ->disabled()
                            ->dehydrated(false)
                            ->visible(fn ($livewire) => $livewire instanceof EditRecord),

                        DateTimePicker::make('updated_at')
                            ->label('Last Updated')
                            ->disabled()
                            ->dehydrated(false)
                            ->visible(fn ($livewire) => $livewire instanceof EditRecord),
                    ])
            ]);
    }
}
