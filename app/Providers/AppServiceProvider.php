<?php

namespace App\Providers;

use App\Models\LeaseAgreement;
use App\Models\SubscriptionPackage;
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
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Rappasoft\LaravelAuthenticationLog\Models\AuthenticationLog;
use Spatie\CpuLoadHealthCheck\CpuLoadCheck;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DatabaseConnectionCountCheck;
use Spatie\Health\Checks\Checks\DatabaseTableSizeCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\PingCheck;
use Spatie\Health\Checks\Checks\QueueCheck;
use Spatie\Health\Checks\Checks\RedisCheck;
use Spatie\Health\Checks\Checks\RedisMemoryUsageCheck;
use Spatie\Health\Checks\Checks\ScheduleCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Facades\Health;
use Spatie\SecurityAdvisoriesHealthCheck\SecurityAdvisoriesCheck;

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
        $this->spatieLaravelHealthCheckPlugin();

        Gate::policy(AuthenticationLog::class, AuthenticationLogPolicy::class);

        Section::configureUsing(fn (Section $section): Section => $section->columnSpanFull());

        Relation::morphMap([
            'lease' => LeaseAgreement::class,
            'subscription' => SubscriptionPackage::class,
        ]);
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
        Model::preventAccessingMissingAttributes($this->app->isProduction());
    }

    private function configureCommands(): void
    {
        $this->filamentShieldProhibitDestructiveCommands();
        DB::prohibitDestructiveCommands($this->app->isProduction());
    }

    public function spatieLaravelHealthCheckPlugin(): void
    {
        Health::checks([
            RedisCheck::new(),
            RedisMemoryUsageCheck::new()
                ->warnWhenAboveMb(900),

            CacheCheck::new(),

            DatabaseCheck::new(),
            DatabaseConnectionCountCheck::new(),
            DatabaseTableSizeCheck::new(),

            SecurityAdvisoriesCheck::new(),
            PingCheck::new()->url(config('app.admin_panel_url'))->timeout(2),

            QueueCheck::new(),
            CpuLoadCheck::new(),
            UsedDiskSpaceCheck::new()
                ->warnWhenUsedSpaceIsAbovePercentage(60),

            ScheduleCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            OptimizedAppCheck::new(),
        ]);
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
