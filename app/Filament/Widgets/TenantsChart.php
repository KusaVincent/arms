<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Common\CountPerMonth;
use App\Models\Tenant;
use Filament\Widgets\ChartWidget;

class TenantsChart extends ChartWidget
{
    protected static ?int $sort = 4;

    protected string $color = 'warning';

    protected ?string $maxHeight = '300px';

    protected ?string $heading = 'Tenants Chart';

    protected function getData(): array
    {
        $data = $this->getCountOfTenantsPerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'Tenants Created',
                    'data' => $data['countOfTenantsPerMonth'],
                ],
            ],
            'labels' => $data['months'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getCountOfTenantsPerMonth(): array
    {
        $data = new CountPerMonth()->getCountPerMonth(new Tenant);

        return [
            'months' => $data->keys()->toArray(),
            'countOfTenantsPerMonth' => $data->values()->toArray(),
        ];
    }
}
