<?php

namespace App\Support;

class DashboardCache
{
    public static function stats(string $modelName): string
    {
        return "dashboard_stats_{$modelName}";
    }

    public static function trends(string $modelName): string
    {
        return "dashboard_trends_chart_{$modelName}";
    }

    public static function widget(string $widget): string
    {
        return "dashboard_widget_{$widget}";
    }
}
