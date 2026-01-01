<?php

namespace App\Traits;

use AlizHarb\ActivityLog\ActivityLogPlugin;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use EightCedars\FilamentInactivityGuard\FilamentInactivityGuardPlugin;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;
use Tapp\FilamentAuthenticationLog\FilamentAuthenticationLogPlugin;

trait HasPanelMethods
{
    protected function getMiddlewares(): array
    {
        return [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            DisableBladeIconComponents::class,
            DispatchServingFilamentEvent::class,
        ];
    }

    protected function getUserMenuItems(): array
    {
        return [
            Action::make('change-password')
                ->label('Change Password')
                ->modalWidth('lg')
                ->icon(Heroicon::OutlinedKey)
                ->schema($this->getChangePasswordForm())
                ->modalHeading('Update Password')
                ->action(function (array $data) {
                    auth()->user()->update(['password' => Hash::make($data['new_password'])]);
                    Notification::make()->title('Password updated Successfully')->success()->send();
                }),
            'logout' => fn (Action $action) => $action->label('Log out')->color('danger'),
        ];
    }

    protected function getPlugins(): array
    {
        return [
            ActivityLogPlugin::make()
                ->navigationSort(1)
                ->navigationGroup('Security Management System'),

            FilamentShieldPlugin::make()
                ->navigationBadge()
                ->navigationGroup('Security Management System')
                ->gridColumns(['default' => 1, 'sm' => 2, 'lg' => 3]),

            FilamentBackgroundsPlugin::make()
                ->imageProvider(MyImages::make()->directory('storage/background-images')),

            FilamentInactivityGuardPlugin::make()
                ->inactiveAfter(5 * Carbon::SECONDS_PER_MINUTE)
                ->enabled(! app()->isLocal()),

            FilamentAuthenticationLogPlugin::make(),

            FilamentSpatieLaravelHealthPlugin::make()
                ->authorize(fn () => auth()->user()->can('View:HealthCheckResults')),
        ];
    }

    protected function getNavigations(): array
    {
        return [
            NavigationGroup::make()
                ->icon(Heroicon::Home)
                ->label('Property Management'),

            NavigationGroup::make()
                ->label('Payments')
                ->icon(Heroicon::OutlinedCurrencyDollar),

            NavigationGroup::make()
                ->icon(Heroicon::UserGroup)
                ->label('Customer Management'),

            NavigationGroup::make()
                ->icon(Heroicon::Backspace)
                ->label('Subscription Management'),

            NavigationGroup::make()
                ->collapsed()
                ->icon(Heroicon::ShieldCheck)
                ->label('Security Management System'),

            NavigationGroup::make()
                ->label('Logins')
                ->icon(Heroicon::LockClosed),

            NavigationGroup::make()
                ->label('Settings')
                ->icon(Heroicon::Cog8Tooth),
        ];
    }

    protected function getChangePasswordForm(): array
    {
        return [
            TextInput::make('current_password')
                ->password()
                ->required()
                ->currentPassword()
                ->revealable(),

            TextInput::make('new_password')
                ->label('New Password')
                ->password()
                ->required()
                ->rule(Password::default())
                ->confirmed()
                ->revealable(),

            TextInput::make('new_password_confirmation')
                ->label('Confirm New Password')
                ->password()
                ->required()
                ->revealable(),
        ];
    }
}
