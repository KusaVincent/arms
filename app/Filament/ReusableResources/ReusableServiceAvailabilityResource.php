<?php

namespace App\Filament\ReusableResources;

use App\Enums\ActiveServiceAvailability;
use App\Utils\SanitizationHelper;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables;
use Filament\Tables\Table;

class ReusableServiceAvailabilityResource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('service_name')
                            ->required()
                            ->label('Service Name'),
                        Forms\Components\Section::make()
                            ->description('This field is what is used by the system to check if service is active or not')
                            ->schema([
                                Forms\Components\TextInput::make('service_key')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->label('Service Key'),
                            ]),
                        Forms\Components\Select::make('is_active')
                            ->label('Active')
                            ->default(ActiveServiceAvailability::NO)
                            ->options(ActiveServiceAvailability::class),
                    ]),
            ]);
    }

    public static function columns(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service_name')
                    ->label('Service'),
                Tables\Columns\TextColumn::make('service_key')
                    ->label('Key'),
                Tables\Columns\TextColumn::make('is_active')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->label('Active'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Added On')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Date Updated')
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
