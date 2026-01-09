<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Common\MonthlyCountChartWidget;
use App\Models\Operator;

class OperatorsChart extends MonthlyCountChartWidget
{
    protected string $label = 'Operators';
    protected string $modelClass = Operator::class;

    protected ?string $heading = 'Operators Created Over Time';

    protected string $backgroundColor = 'rgba(16, 185, 129, 0.2)';

    public static function getSort(): int
    {
        return 3;
    }
}
