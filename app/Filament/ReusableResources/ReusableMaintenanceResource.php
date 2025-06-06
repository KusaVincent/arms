<?php

namespace App\Filament\ReusableResources;

use App\Enums\MaintenanceStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables;
use Filament\Tables\Table;

class ReusableMaintenanceResource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Select::make('property_id')
                                    ->required()
                                    ->searchable()
                                    ->relationship('property', 'name'),
                                Forms\Components\Select::make('tenant_id')
                                    ->required()
                                    ->searchable()
                                    ->relationship('tenant', 'first_name'),
                                Forms\Components\Select::make('status')
                                    ->native(false)
                                    ->options(MaintenanceStatus::class)
                                    ->default(MaintenanceStatus::PENDING),
                            ])->columns(3),
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\DatePicker::make('request_date')
                                    ->date()
                                    ->required(),
                                Forms\Components\DatePicker::make('completion_date')
                                    ->date()
                                    ->required(),
                            ])->columns()
                            ->visible(fn ($livewire): bool => $livewire instanceof ViewRecord),
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\MarkdownEditor::make('description')
                                    ->required(),
                            ]),
                    ]),
            ]);
    }

    public static function columns(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('property.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tenant.fullname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->limit(10),
                Tables\Columns\TextColumn::make('request_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('completion_date')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Added On')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Date Updated')
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
