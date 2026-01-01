<?php

namespace App\Filament\ReusableResources\ResourceForm;

use App\Filament\Resources\Common\SelectField;
use App\Models\Tenant;
use App\Utils\SanitizationHelper;
use Exception;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LeaseAgreementForm
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
                                SelectField::make('tenant_id')
                                    ->label('Tenant')
                                    ->required()
                                    ->getSearchResultsUsing(fn (string $search): array => Tenant::query()
                                        ->whereHas('user', function ($query) use ($search) {
                                            $query->where('name', 'ilike', "%{$search}%");
                                        })
                                        ->get()
                                        ->mapWithKeys(fn ($tenant) => [$tenant->id => $tenant->user->name])
                                        ->toArray()
                                    )
                                    ->getOptionLabelUsing(fn ($value): ?string => Tenant::find($value)?->user?->name
                                    ),
                                SelectField::make('property_id')
                                    ->required()
                                    ->relationship('property', 'name'),
                            ])->columns(),
                        Section::make()
                            ->schema([
                                DatePicker::make('lease_start_date')
                                    ->date()
                                    ->required(),
                                DatePicker::make('lease_end_date')
                                    ->date(),
                                TextInput::make('lease_term')
                                    ->required(),
                            ])->columns(3),
                        Section::make()
                            ->schema([
                                TextInput::make('lease_amount')
                                    ->required()
                                    ->formatStateUsing(fn ($state, $livewire) => $livewire instanceof EditRecord
                                        ? SanitizationHelper::stripFormatting($state)
                                        : $state
                                    )
                                    ->dehydrateStateUsing(fn ($state) => $state)
                                    ->rules(fn ($livewire): array => $livewire instanceof ViewRecord ? [] : ['numeric']),
                                TextInput::make('deposit_amount')
                                    ->required()
                                    ->formatStateUsing(fn ($state, $livewire) => $livewire instanceof EditRecord
                                        ? SanitizationHelper::stripFormatting($state)
                                        : $state
                                    )
                                    ->dehydrateStateUsing(fn ($state) => $state)
                                    ->rules(fn ($livewire): array => $livewire instanceof ViewRecord ? [] : ['numeric']),
                            ])->columns(),
                    ]),
            ]);
    }
}
