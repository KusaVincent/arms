<?php

namespace App\Filament\Resources\PackageSubscriptions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PackageSubscriptionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('no_of_properties'),
                TextEntry::make('no_of_support_team'),
                TextEntry::make('package_price'),
                TextEntry::make('negotiated_price'),
                TextEntry::make('status'),
                TextEntry::make('effective_date'),
                TextEntry::make('expiry_date'),
            ]);
    }
}
