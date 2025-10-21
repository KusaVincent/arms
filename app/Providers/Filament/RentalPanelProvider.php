<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\CustomRegister;
use App\Filament\Pages\Tenancy\EditRelationship;
use App\Filament\Pages\Tenancy\RegisterRelationship;
use App\Models\Client;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use BezhanSalleh\FilamentShield\Middleware\SyncShieldTenant;
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

class RentalPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->login()
            ->default()
            ->id('rental')
            ->path('rental')
            ->font('Poppins')
            ->pages([Dashboard::class])
            ->sidebarCollapsibleOnDesktop()
            ->brandLogoHeight('3.5rem')
            ->colors(['primary' => Color::Blue])
            ->registration(CustomRegister::class)
            ->favicon(asset('storage/favicon.png'))
            ->tenantProfile(EditRelationship::class)
            ->brandLogo(asset('storage/logo/logo.png'))
            ->tenantRegistration(RegisterRelationship::class)
            ->darkModeBrandLogo(asset('storage/logo/logo.png'))
            ->tenant(Client::class, 'slug', 'client')
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
                AddQueuedCookiesToResponse::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])->plugins([
                FilamentAuthenticationLogPlugin::make(),
                FilamentShieldPlugin::make()
                    ->gridColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 3,
                    ])
                    ->sectionColumnSpan(1)
                    ->checkboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 4,
                    ])
                    ->resourceCheckboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                    ]),
            ])
            ->tenantMiddleware([
                SyncShieldTenant::class,
            ], isPersistent: true);
    }
}
