<?php

namespace App\Providers\Filament;

use AlizHarb\ActivityLog\ActivityLogPlugin;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Tapp\FilamentAuthenticationLog\FilamentAuthenticationLogPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->login()
            ->default()
            ->id('admin')
            ->font('Poppins')
            ->pages([Dashboard::class])
            ->sidebarCollapsibleOnDesktop()
            ->brandLogoHeight('3rem')
            ->colors(['primary' => Color::Blue])
            ->favicon(asset('storage/favicon.png'))
            ->domain(config('app.admin_panel_url'))
            ->brandLogo(asset('storage/logo/logo.png'))
            ->darkModeBrandLogo(asset('storage/logo/logo.png'))
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                StartSession::class,
                EncryptCookies::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                DisableBladeIconComponents::class,
                AddQueuedCookiesToResponse::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])->plugins([
                ActivityLogPlugin::make()
                    ->label('Activity Log')
                    ->pluralLabel('Activity Logs')
                    ->navigationGroup('Security Management System'),
                FilamentShieldPlugin::make()
                    ->navigationBadge()
                    ->globallySearchable()
                    ->sectionColumnSpan(1)
                    ->navigationGroup('Security Management System')
                    ->globalSearchResultsLimit(50)
                    ->forceGlobalSearchCaseInsensitive()
                    ->navigationBadgeColor('success')
                    ->gridColumns(['default' => 1, 'sm' => 2, 'lg' => 3])
                    ->resourceCheckboxListColumns(['default' => 1, 'sm' => 2])
                    ->checkboxListColumns(['default' => 1, 'sm' => 2, 'lg' => 4]),
                FilamentAuthenticationLogPlugin::make(),
            ]);
    }
}
