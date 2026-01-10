<?php

namespace App\Filament\Resources\LeaseAgreements\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Filament\Support\Icons\Heroicon;

class LeaseAgreementInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Lease Agreement Overview')
                    ->description('View contractual terms and financial status.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Group::make([
                                    Section::make('Agreement Logistics')
                                        ->icon(Heroicon::ClipboardDocumentList)
                                        ->compact()
                                        ->schema([
                                            Grid::make()->schema([
                                                TextEntry::make('tenant.user.name')
                                                    ->label('Tenant Name')
                                                    ->weight(FontWeight::Bold),

                                                TextEntry::make('property.name')
                                                    ->label('Assigned Property')
                                                    ->color('primary'),
                                            ]),

                                            Grid::make(3)->schema([
                                                TextEntry::make('lease_start_date')
                                                    ->label('Start Date')
                                                    ->date(),
                                                TextEntry::make('lease_end_date')
                                                    ->label('End Date')
                                                    ->date()
                                                    ->placeholder('No end date set'),
                                                TextEntry::make('lease_term')
                                                    ->label('Contract Term'),
                                            ]),
                                        ]),

                                    Section::make('Financial Commitment')
                                        ->icon(Heroicon::Banknotes)
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('lease_amount')
                                                ->label('Monthly Rental')
                                                ->size(TextSize::Large)
                                                ->weight(FontWeight::Bold),

                                            TextEntry::make('deposit_amount')
                                                ->label('Security Deposit')
                                                ->money('INR'),
                                        ])->columns(2),
                                ])->columnSpan(2),

                                Group::make([
                                    Section::make('Verification')
                                        ->icon(Heroicon::ShieldCheck)
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('payment_confirmation')
                                                ->label('Payment Status')
                                                ->badge(),
                                        ]),

                                    Section::make('System Metadata')
                                        ->icon(Heroicon::FingerPrint)
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('created_at')
                                                ->label('Signed At')
                                                ->dateTime(),
                                            TextEntry::make('updated_at')
                                                ->label('Last Modified')
                                                ->since()
                                                ->size(TextSize::Small),
                                        ]),
                                ])->columnSpan(1),
                            ]),
                    ]),
            ]);
    }
}
