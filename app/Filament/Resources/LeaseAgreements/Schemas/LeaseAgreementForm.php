<?php

namespace App\Filament\Resources\LeaseAgreements\Schemas;

use App\Enums\PaymentConfirmation;
use App\Filament\ReusableResources\Common\MoneyField;
use App\Filament\ReusableResources\Common\SelectField;
use App\Models\Tenant;
use Exception;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class LeaseAgreementForm
{
    /**
     * @throws Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Lease Agreement Management')
                    ->description('Define the contractual relationship between a tenant and a property.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Group::make([
                                    Section::make('Parties Involved')
                                        ->icon(Heroicon::Users)
                                        ->compact()
                                        ->schema([
                                            SelectField::make('tenant_id')
                                                ->label('Tenant Name')
                                                ->required()
                                                ->getSearchResultsUsing(fn (string $search): array => Tenant::query()
                                                    ->whereHas('user', function ($query) use ($search) {
                                                        $query->where('name', 'ilike', "%{$search}%");
                                                    })
                                                    ->get()
                                                    ->mapWithKeys(fn ($tenant) => [$tenant->id => $tenant->user->name])
                                                    ->toArray()
                                                )
                                                ->getOptionLabelUsing(fn ($value): ?string => Tenant::find($value)?->user?->name),

                                            SelectField::make('property_id')
                                                ->label('Assigned Property')
                                                ->required()
                                                ->relationship('property', 'name'),
                                        ])->columns(2),

                                    Section::make('Lease Duration')
                                        ->icon(Heroicon::CalendarDays)
                                        ->compact()
                                        ->schema([
                                            DatePicker::make('lease_start_date')
                                                ->required()
                                                ->native(false),
                                            DatePicker::make('lease_end_date')
                                                ->native(false),
                                            TextInput::make('lease_term')
                                                ->label('Term Description')
                                                ->placeholder('e.g. 12 Months')
                                                ->required(),
                                        ])->columns(3),

                                    Section::make('Financial Terms')
                                        ->icon(Heroicon::Banknotes)
                                        ->compact()
                                        ->schema([
                                            MoneyField::make('lease_amount')
                                                ->label('Monthly Rent')
                                                ->rules(['numeric']),
                                            MoneyField::make('deposit_amount')
                                                ->label('Security Deposit')
                                                ->rules(['numeric']),
                                        ])->columns(2),
                                ])->columnSpan(2),

                                Group::make([
                                    Section::make('Verification')
                                        ->icon(Heroicon::ShieldCheck)
                                        ->compact()
                                        ->schema([
                                            SelectField::make('payment_confirmation')
                                                ->label('Payment Status')
                                                ->options(PaymentConfirmation::class)
                                                ->required()
                                                ->native(false)
                                                ->live()
                                                ->prefixIcon(function ($state) {
                                                    if (! $state) return Heroicon::CheckBadge;

                                                    $enum = $state instanceof PaymentConfirmation
                                                        ? $state
                                                        : PaymentConfirmation::tryFrom($state);

                                                    return $enum?->getIcon() ?? Heroicon::CheckBadge;
                                                })
                                                ->prefixIconColor(function ($state) {
                                                    if (! $state) return 'gray';

                                                    $enum = $state instanceof PaymentConfirmation
                                                        ? $state
                                                        : PaymentConfirmation::tryFrom($state);

                                                    return $enum?->getColor() ?? 'gray';
                                                }),
                                        ]),

                                    Section::make('Audit Trail')
                                        ->icon(Heroicon::Clock)
                                        ->compact()
                                        ->visible(fn ($livewire) => $livewire instanceof EditRecord)
                                        ->schema([
                                            DateTimePicker::make('created_at')
                                                ->label('Record Created')
                                                ->disabled()
                                                ->dehydrated(false),
                                            DateTimePicker::make('updated_at')
                                                ->label('Last Activity')
                                                ->disabled()
                                                ->dehydrated(false),
                                        ]),
                                ])->columnSpan(1),
                            ]),
                    ]),
            ]);
    }
}
