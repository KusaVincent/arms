<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Common\MonthlyCountChartWidget;
use App\Models\Property;

class PropertiesChart extends MonthlyCountChartWidget
{
    protected string $label = 'Properties';

    protected string $modelClass = Property::class;

    protected string $borderColor = '#f59e0b';

    protected ?string $heading = 'Properties Created Over Time';

    protected string $backgroundColor = 'rgba(245, 158, 11, 0.2)';

    public static function getSort(): int
    {
        return 2;
    }
}
