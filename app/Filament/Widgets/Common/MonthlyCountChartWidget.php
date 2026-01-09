<?php

namespace App\Filament\Widgets\Common;

use Illuminate\Support\Facades\Cache;
use App\Support\DashboardCache;

abstract class MonthlyCountChartWidget extends BaseLineChartWidget
{
    protected string $modelClass;

    protected string $label;

    protected string $borderColor = '#3b82f6';

    protected string $backgroundColor = 'rgba(59, 130, 246, 0.2)';

    protected ?string $cacheKey = null;

    protected ?string $maxHeight = '300px';

    protected function getCacheKey(): string
    {
        return $this->cacheKey ?? DashboardCache::widget(strtolower(class_basename($this->modelClass)) . '_chart');
    }

    protected function getData(): array
    {
        return Cache::remember(
            $this->getCacheKey(),
            now()->addHours(6),
            fn () => $this->buildChartData()
        );
    }

    protected function buildChartData(): array
    {
        $data = new CountPerMonth()->getCountPerMonth(new $this->modelClass());

        return [
            'labels' => $data->keys()->toArray(),
            'datasets' => [
                $this->defaultDataset(
                    $data->values()->toArray(),
                    $this->label,
                    $this->borderColor,
                    $this->backgroundColor
                ),
            ],
        ];
    }
}
