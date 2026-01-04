<?php

namespace App\Filament\Widgets;

use App\Filament\Widgets\Common\CountPerMonth;
use App\Models\Operator;
use Filament\Widgets\ChartWidget;

class OperatorsChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected string $color = 'primary';

    protected ?string $maxHeight = '300px';

    protected ?string $heading = 'Operators Chart';

    protected function getData(): array
    {
        $data = $this->getCountOfOperatorsPerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'Operators Created',
                    'data' => $data['countOfOperatorsPerMonth'],
                ],
            ],
            'labels' => $data['months'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getCountOfOperatorsPerMonth(): array
    {
        $data = new CountPerMonth()->getCountPerMonth(new Operator);

        return [
            'months' => $data->keys()->toArray(),
            'countOfOperatorsPerMonth' => $data->values()->toArray(),
        ];
    }
}
