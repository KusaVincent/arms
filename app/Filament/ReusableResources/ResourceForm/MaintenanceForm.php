<?php

namespace App\Filament\ReusableResources\ResourceForm;

use App\Enums\MaintenanceStatus;
use Exception;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MaintenanceForm
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
                        Section::make()
                            ->schema([
                                Select::make('property_id')
                                    ->required()
                                    ->searchable()
                                    ->relationship('property', 'name'),
                                Select::make('tenant_id')
                                    ->required()
                                    ->searchable()
                                    ->relationship('tenant', 'first_name'),
                                Select::make('status')
                                    ->native(false)
                                    ->options(MaintenanceStatus::class)
                                    ->default(MaintenanceStatus::PENDING),
                            ])->columns(3),
                        Section::make()
                            ->schema([
                                DatePicker::make('request_date')
                                    ->date()
                                    ->required(),
                                DatePicker::make('completion_date')
                                    ->date()
                                    ->required(),
                            ])->columns()
                            ->visible(fn ($livewire): bool => $livewire instanceof ViewRecord),
                        Section::make()
                            ->schema([
                                MarkdownEditor::make('description')
                                    ->required(),
                            ]),
                    ]),
            ]);
    }
}
