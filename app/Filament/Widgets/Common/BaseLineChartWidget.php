<?php

namespace App\Filament\Widgets\Common;

use Filament\Widgets\ChartWidget;

abstract class BaseLineChartWidget extends ChartWidget
{
    public static function getSort(): int
    {
        return 3;
    }

    protected function getPollingInterval(): ?string
    {
        return '5m';
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function defaultDataset(array $data, string $label = 'Total', string $borderColor = '#3b82f6', string $backgroundColor = 'rgba(59, 130, 246, 0.2)'): array
    {
        return [
            'label' => $label,
            'data' => $data,
            'borderColor' => $borderColor,
            'backgroundColor' => $backgroundColor,
            'fill' => true,
            'tension' => 0.4,
            'borderWidth' => 2,
        ];
    }
}
