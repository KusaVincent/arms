<?php

namespace App\Providers;

use App\Policies\AuthenticationLogPolicy;
use App\Services\ElasticSearchService;
use BezhanSalleh\FilamentShield\Commands\GenerateCommand;
use BezhanSalleh\FilamentShield\Commands\InstallCommand;
use BezhanSalleh\FilamentShield\Commands\PublishCommand;
use BezhanSalleh\FilamentShield\Commands\SeederCommand;
use BezhanSalleh\FilamentShield\Commands\SetupCommand;
use BezhanSalleh\FilamentShield\Commands\SuperAdminCommand;
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
    #[\Override]
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

        Gate::policy(AuthenticationLog::class, AuthenticationLogPolicy::class);
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
        $this->filamentShieldProhibitDestructiveCommands();
        DB::prohibitDestructiveCommands($this->app->isProduction());
    }

    private function filamentShieldProhibitDestructiveCommands(): void
    {
        SetupCommand::prohibit($this->app->isProduction());
        SeederCommand::prohibit($this->app->isProduction());
        InstallCommand::prohibit($this->app->isProduction());
        PublishCommand::prohibit($this->app->isProduction());
        GenerateCommand::prohibit($this->app->isProduction());
        SuperAdminCommand::prohibit($this->app->isProduction());
    }
}
