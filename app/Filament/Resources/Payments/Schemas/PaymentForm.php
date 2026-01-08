<?php

namespace App\Filament\Resources\Payments\Schemas;

use App\Filament\ReusableResources\Common\SelectField;
use App\Models\LeaseAgreement;
use App\Models\PackageSubscription;
use App\Utils\SanitizationHelper;
use Exception;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaymentForm
{
    /**
     * @throws Exception
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        MorphToSelect::make('payable')
                            ->required()
                            ->searchable()
                            ->label('Paid Towards')
                            ->loadingMessage(__('Loading...'))
                            ->searchPrompt(__('Start typing to search...'))
                            ->noSearchResultsMessage(__('No options match your search.'))
                            ->types([
                                MorphToSelect\Type::make(LeaseAgreement::class)
                                    ->label('Lease Agreement')
                                    ->getOptionLabelFromRecordUsing(fn (LeaseAgreement $record) => "{$record->property?->name} (Lease #{$record->id} - {$record->tenant?->user?->name})"
                                    )
                                    ->getOptionsUsing(function (?string $search): array {
                                        return LeaseAgreement::query()
                                            ->with(['property', 'tenant.user']) // Eager load to prevent N+1
                                            ->when($search, function ($query) use ($search) {
                                                $query->whereHas('property', fn ($q) => $q->where('name', 'ilike', "%{$search}%"))
                                                    ->orWhere('id', 'like', "%{$search}%");
                                            })
                                            ->limit(50)
                                            ->get()
                                            ->mapWithKeys(fn ($record) => [
                                                $record->id => "{$record->property?->name} (Ref: #{$record->id} - {$record->tenant?->user?->name})",
                                            ])
                                            ->toArray();
                                    }),

                                MorphToSelect\Type::make(PackageSubscription::class)
                                    ->label('Package Subscription')
                                    ->getOptionLabelFromRecordUsing(fn (PackageSubscription $record) =>
                                    "{$record->packageDescription?->name} (User: {$record->operator?->user?->name})"
                                    )
                                    ->getOptionsUsing(function (?string $search): array {
                                        return PackageSubscription::query()
                                            ->with(['packageDescription', 'operator.user'])
                                            ->when($search, function ($query) use ($search) {
                                                $query->whereHas('packageDescription', fn ($q) =>
                                                $q->where('name', 'ilike', "%{$search}%")
                                                )
                                                    ->orWhereHas('operator.user', fn ($q) =>
                                                    $q->where('name', 'ilike', "%{$search}%")
                                                    )
                                                    ->orWhere('id', 'like', "%{$search}%");
                                            })
                                            ->limit(50)
                                            ->get()
                                            ->mapWithKeys(fn ($record) => [
                                                $record->id => "{$record->packageDescription?->name} (User: {$record->operator?->user?->name})",
                                            ])
                                            ->toArray();
                                    }),
                            ])
                            ->columns(),
                    ]),
                Section::make()
                    ->schema([
                        SelectField::make('payment_method_id')
                            ->required()
                            ->label('Payment Method')
                            ->relationship('paymentMethod', 'name'),
                        TextInput::make('payment_amount')
                            ->required()
                            ->formatStateUsing(fn ($state, $livewire) => $livewire instanceof EditRecord
                                ? SanitizationHelper::stripFormatting($state)
                                : $state
                            )
                            ->label('Payment Amount')
                            ->dehydrateStateUsing(fn ($state) => $state)
                            ->rules(fn ($livewire): array => $livewire instanceof ViewRecord ? [] : ['numeric']),
                        DatePicker::make('payment_date')
                            ->date()
                            ->required()
                            ->label('Payment Date'),
                    ])->columns(3),
            ]);
    }
}
