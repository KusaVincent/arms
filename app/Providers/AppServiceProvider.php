<?php

namespace App\Providers;

use App\Services\ElasticSearchService;
use Filament\Schemas\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use BezhanSalleh\FilamentShield\Commands\{
    GenerateCommand, InstallCommand, PublishCommand, SetupCommand
};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->configureUrl();
        $this->app->singleton('elasticsearchservice', fn ($app): ElasticSearchService => new ElasticSearchService);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureModels();
        $this->configureCommands();

        Section::configureUsing(fn (Section $section): Section => $section->columnSpanFull());
    }

    private function configureUrl(): void
    {
        if (! $this->app->isLocal()) {
            URL::forceScheme('https');
        }
    }

    private function configureModels(): void
    {
        Model::unguard();
        Model::shouldBeStrict();
        Model::automaticallyEagerLoadRelationships();

    }

    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(
            $this->app->isProduction()
        );

        $this->filamentShieldProhibitDestructiveCommands();
    }

    private function filamentShieldProhibitDestructiveCommands(): void
    {
        SetupCommand::prohibit($this->app->isProduction());
        InstallCommand::prohibit($this->app->isProduction());
        GenerateCommand::prohibit($this->app->isProduction());
        PublishCommand::prohibit($this->app->isProduction());
    }
}
