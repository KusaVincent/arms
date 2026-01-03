<?php

namespace App\Filament\Widgets\Common;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class CountPerMonth
{
    public function getCountPerMonth(Model $model): Collection
    {
        $now = Carbon::now();

        $modelQuery = $model::query()
            ->whereYear('created_at', $now->year)
            ->toBase()
            ->get(['created_at']);

        $counts = $modelQuery->groupBy(fn ($item) => Carbon::parse($item->created_at)->month)
            ->map(fn ($group) => $group->count());

        return collect(range(1, 12))->mapWithKeys(function ($monthNumber) use ($now, $counts) {
            $monthName = $now->copy()->month($monthNumber)->format('M');

            return [$monthName => $counts->get($monthNumber, 0)];
        });
    }
}
