<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\EditProfile;
use App\Traits\HasPanelMethods;
use Filament\Http\Middleware\Authenticate;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;

class AdminPanelProvider extends PanelProvider
{
    use HasPanelMethods;

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->login()
            ->default()
            ->id('admin')
            ->profile(EditProfile::class)
            ->domain(config('app.admin_panel_url'))

            ->font('Poppins')
            ->sidebarCollapsibleOnDesktop()
            ->brandLogoHeight('3rem')
            ->colors(['primary' => Color::Blue])
            ->favicon(asset('storage/favicon.png'))
            ->brandLogo(asset('storage/logo/logo.png'))
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->darkModeBrandLogo(asset('storage/logo/logo.png'))

            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')

            ->pages([Dashboard::class])

            ->plugins($this->getPlugins())

            ->middleware($this->getMiddlewares())

            ->authMiddleware([Authenticate::class])

            ->userMenuItems($this->getUserMenuItems())

            ->navigationGroups($this->getNavigations());
    }
}
