<?php

namespace App\Providers;

use App\Policies\AuthenticationLogPolicy;
use App\Services\ElasticSearchService;
use BezhanSalleh\FilamentShield\Commands\GenerateCommand;
use BezhanSalleh\FilamentShield\Commands\InstallCommand;
use BezhanSalleh\FilamentShield\Commands\PublishCommand;
use BezhanSalleh\FilamentShield\Commands\SetupCommand;
use Filament\Schemas\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog;

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

        Gate::policy(AuthenticationLog::class, AuthenticationLogPolicy::class);
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
