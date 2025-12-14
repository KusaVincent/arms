<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\UserService;
use App\Traits\Referenceable;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static create()
 */
final class User extends Authenticatable implements Auditable, FilamentUser
{
    use AuditableTrait, AuthenticationLoggable, HasFactory,HasPanelShield,HasRoles,KeepsDeletedModels,Notifiable, Referenceable;

    protected string $referencePrefix = 'USR';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //    public function clients(): BelongsToMany
    //    {
    //        return $this->belongsToMany(Client::class);
    //    }

    //    public function getTenants(Panel $panel): Collection
    //    {
    //        return $this->clients;
    //    }

    //    public function canAccessTenant(Model $tenant): bool
    //    {
    //        return $this->clients()->whereKey($tenant)->exists();
    //    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    //    #[\Override]
    //    protected static function booted(): void
    //    {
    //        self::created(function (User $user): void {
    //            if (app()->runningInConsole() && ! $user->roles()->exists()) {
    //                $userService = app(UserService::class);
    //                $userService->assignDefaultRoleToUser($user);
    //            }
    //        });
    //    }
}
