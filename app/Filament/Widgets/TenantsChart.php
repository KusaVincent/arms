<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Common\MonthlyCountChartWidget;
use App\Models\Tenant;

class TenantsChart extends MonthlyCountChartWidget
{
    protected string $label = 'Tenants';

    protected string $modelClass = Tenant::class;

    protected string $borderColor = '#f97316';

    protected ?string $heading = 'Tenants Created Over Time';

    protected string $backgroundColor = 'rgba(249, 115, 22, 0.2)';

    public static function getSort(): int
    {
        return 4;
    }
}
