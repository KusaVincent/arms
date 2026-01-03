<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Common\CountPerMonth;
use App\Models\Property;
use Filament\Widgets\ChartWidget;

class PropertiesChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected string $color = 'success';

    protected ?string $maxHeight = '300px';

    protected ?string $heading = 'Properties Chart';

    protected function getData(): array
    {
        $data = $this->getCountOfPropertiesPerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'Properties Created',
                    'data' => $data['countOfPropertiesPerMonth'],
                ]
            ],
            'labels' => $data['months']
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getCountOfPropertiesPerMonth(): array
    {
        $data = new CountPerMonth()->getCountPerMonth(new Property());

        return [
            'months' => $data->keys()->toArray(),
            'countOfPropertiesPerMonth' => $data->values()->toArray(),
        ];
    }
}
