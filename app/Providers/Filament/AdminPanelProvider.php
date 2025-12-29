<?php

namespace App\Providers\Filament;

use AlizHarb\ActivityLog\ActivityLogPlugin;
use App\Filament\Pages\Auth\EditProfile;
use App\Filament\Resources\Users\UserResource;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use EightCedars\FilamentInactivityGuard\FilamentInactivityGuardPlugin;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Notifications\Notification;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;
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
            ->profile(EditProfile::class)
            ->colors(['primary' => Color::Blue])
            ->favicon(asset('storage/favicon.png'))
            ->domain(config('app.admin_panel_url'))
            ->brandLogo(asset('storage/logo/logo.png'))
            ->darkModeBrandLogo(asset('storage/logo/logo.png'))
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->widgets([
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
            ->userMenuItems([
                Action::make('change-password')
                    ->label('Change Password')
                    ->icon('heroicon-o-key')
                    ->modalHeading('Update Password')
                    ->modalDescription('Please ensure your account is using a long, random password to stay secure.')
                    ->modalSubmitActionLabel('Update')
                    ->modalWidth('lg')
                    ->form([
                        TextInput::make('current_password')
                            ->password()
                            ->required()
                            ->currentPassword(),
                        TextInput::make('new_password')
                            ->label('New Password')
                            ->password()
                            ->required()
                            ->rule(Password::default())
                            ->confirmed(),
                        TextInput::make('new_password_confirmation')
                            ->label('Confirm New Password')
                            ->password()
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        auth()->user()->update([
                            'password' => Hash::make($data['new_password']),
                        ]);

                        Notification::make()
                            ->title('Password updated successfully')
                            ->success()
                            ->send();
                    }),
                'logout' => fn (Action $action) => $action
                    ->label('Log out')
                    ->icon('heroicon-o-arrow-left-on-rectangle')
                    ->color('danger'),
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
                FilamentBackgroundsPlugin::make()
                    ->remember(60000)
                    ->imageProvider(
                        MyImages::make()
                            ->directory('storage/background-images')
                    ),
                FilamentInactivityGuardPlugin::make()
                    ->inactiveAfter(5 * Carbon::SECONDS_PER_MINUTE)
                    ->showNoticeFor(1 * Carbon::SECONDS_PER_MINUTE)
                    ->enabled(! app()->isLocal())
                    ->keepActiveOn(['change', 'select', 'mousemove']),
                FilamentAuthenticationLogPlugin::make(),
                FilamentSpatieLaravelHealthPlugin::make()
                    ->authorize(fn () => auth()->user()->can('View:HealthCheckResults')),
            ]);
    }
}
