<?php

namespace App\Filament\Widgets;

use App\Models\Amenity;
use App\Models\Location;
use App\Models\Operator;
use App\Models\PackageDescription;
use App\Models\PaymentMethod;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Tenant;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected int|array|null $columns = 4;

    protected ?string $pollingInterval = '15s';

    private function chart(): array
    {
        return [7, 3, 4, 5, 6, 3, 5, 3];
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Properties', Property::count())
                ->description('Total Properties')
                ->descriptionIcon(Heroicon::ArrowTrendingUp)
                ->color(Color::Blue)
                ->chart($this->chart()),
            Stat::make('Total Available Packages', PackageDescription::count())
                ->description('Total Available Packages')
                ->descriptionIcon(Heroicon::ArrowTrendingUp)
                ->color(Color::Blue)
                ->chart($this->chart()),
            Stat::make('Total Operators', Operator::count())
                ->description('Total Operators')
                ->descriptionIcon(Heroicon::ArrowTrendingUp)
                ->color(Color::Green)
                ->chart($this->chart()),
            Stat::make('Total Tenants', Tenant::count())
                ->description('Total Tenants')
                ->descriptionIcon(Heroicon::ArrowTrendingUp)
                ->color(Color::Amber)
                ->chart($this->chart()),
            Stat::make('Total Property Types', PropertyType::count())
                ->description('Total Property Types')
                ->descriptionIcon(Heroicon::ArrowTrendingUp)
                ->color(Color::Fuchsia)
                ->chart($this->chart()),
            Stat::make('Total Locations Covered', Location::count())
                ->description('Total Locations Covered')
                ->descriptionIcon(Heroicon::ArrowTrendingUp)
                ->color(Color::Emerald)
                ->chart($this->chart()),
            Stat::make('Total Amenities Recorded', Amenity::count())
                ->description('Total Amenities Recorded')
                ->descriptionIcon(Heroicon::ArrowTrendingUp)
                ->color(Color::Lime)
                ->chart($this->chart()),
            Stat::make('Total Payment Methods', PaymentMethod::count())
                ->description('Total Payment Methods')
                ->descriptionIcon(Heroicon::ArrowTrendingUp)
                ->color(Color::Orange)
                ->chart($this->chart()),
        ];
    }
}
