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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected int|array|null $columns = [
        'sm' => 1,
        'md' => 2,
        'lg' => 3,
        'xl' => 4,
    ];

    protected ?string $pollingInterval = '60s';


    protected function getStats(): array
    {
        return [
            $this->createStat('Properties', Property::class, 'Registered listings', Heroicon::HomeModern, Color::Blue),
            $this->createStat('Packages', PackageDescription::class, 'Available plans', Heroicon::ArchiveBox, Color::Indigo),
            $this->createStat('Operators', Operator::class, 'Active operators', Heroicon::UserGroup, Color::Emerald),
            $this->createStat('Tenants', Tenant::class, 'Current tenants', Heroicon::Users, Color::Amber),

            $this->createStat('Property Types', PropertyType::class, 'Supported categories', Heroicon::Squares2x2, Color::Fuchsia),
            $this->createStat('Locations', Location::class, 'Covered areas', Heroicon::MapPin, Color::Cyan),
            $this->createStat('Amenities', Amenity::class, 'Listed amenities', Heroicon::Sparkles, Color::Lime),
            $this->createStat('Payment Methods', PaymentMethod::class, 'Enabled options', Heroicon::CreditCard, Color::Orange),
        ];
    }

    private function createStat(string $label, string $modelClass, $description, Heroicon $icon, array $color) : Stat
    {
        $modelName = strtolower(class_basename($modelClass));

        $cacheKey = "dashboard_stats_{$modelName}";

        return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($label, $modelClass, $description, $icon, $color, $modelName) {

            $now = Carbon::now();
            $thirtyDaysAgo = $now->copy()->subDays(30);
            $sixtyDaysAgo = $now->copy()->subDays(60);

            $totalCount = $modelClass::count();

            $currentPeriodCount = $modelClass::where('created_at', '>=', $thirtyDaysAgo)->count();

            $previousPeriodCount = $modelClass::whereBetween('created_at', [$sixtyDaysAgo, $thirtyDaysAgo])->count();

            if ($previousPeriodCount === 0) {
                $trendPercent = $currentPeriodCount > 0 ? 100 : 0;
            } else {
                $trendPercent = (($currentPeriodCount - $previousPeriodCount) / $previousPeriodCount) * 100;
            }

            $isGrowth = $trendPercent >= 0;

            if (abs($trendPercent) >= 1000) {
                $formattedTrend = '99+';
            } else {
                $formattedTrend = number_format(abs($trendPercent), 1);
            }

            $trendText = $isGrowth ? "↑ {$formattedTrend}%" : "↓ {$formattedTrend}%";

            if ($previousPeriodCount === 0 && $currentPeriodCount > 0) {
                $trendText = "New Growth";
            }

            $combinedDescription = "{$description} ({$trendText})";

            return Stat::make($label, number_format($totalCount))
                ->color($color)
                ->descriptionIcon($icon)
                ->description($combinedDescription)
                ->chart($this->getRealTrendData($modelClass, $modelName))
                ->descriptionColor($isGrowth ? 'success' : 'danger');
        });
    }

    private function getRealTrendData(string $modelClass, string $modelName): array
    {
        return Cache::remember("dashboard_trends_chart_{$modelName}", now()->addMinutes(60), function () use ($modelClass) {
            $data = $modelClass::where('created_at', '>=', now()->subDays(6))
                ->selectRaw('DATE(created_at) as date, count(*) as count')
                ->groupBy('date')
                ->pluck('count', 'date')
                ->toArray();

            return collect(range(6, 0))
                ->map(fn ($daysAgo) => $data[now()->subDays($daysAgo)->format('Y-m-d')] ?? 0)
                ->toArray();
        });
    }
}
