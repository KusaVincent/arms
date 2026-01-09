<?php

namespace App\Observers;

use App\Support\DashboardCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CacheObserver
{
    public function saved(Model $model): void
    {
        $this->clearCache($model);
    }

    public function deleted(Model $model): void
    {
        $this->clearCache($model);
    }

    protected function clearCache(Model $model): void
    {
        $modelName = strtolower(class_basename($model));

        Cache::forget(DashboardCache::stats($modelName));

        Cache::forget(DashboardCache::trends($modelName));

        Cache::forget(DashboardCache::widget("{$modelName}_chart"));
    }
}
