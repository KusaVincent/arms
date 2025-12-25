<?php

namespace App\Filament\Resources\SubscriptionPackages\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SubscriptionPackageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('mnemonic'),
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('payment.id')
                    ->label('Payment'),
                TextEntry::make('packageDescription.name')
                    ->label('Package description'),
                TextEntry::make('no_of_properties')
                    ->numeric(),
                TextEntry::make('no_of_support_team')
                    ->numeric(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('effective_date')
                    ->dateTime(),
                TextEntry::make('expiry_date')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
