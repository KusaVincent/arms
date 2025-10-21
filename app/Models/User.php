<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\Referenceable;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasTenants;
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
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static create()
 * @property int|mixed $client_id
 */
final class User extends Authenticatable implements Auditable, FilamentUser, HasTenants
{
    use AuditableTrait, AuthenticationLoggable, HasFactory,HasPanelShield,HasRoles,KeepsDeletedModels, Notifiable, Referenceable;

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

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class);
    }

    public function getTenants(Panel $panel): Collection
    {
        return $this->clients;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->clients()->whereKey($tenant)->exists();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    protected static function booted()
    {
        static::created(function (User $user) {
            if (!$user->roles()->exists()) {
                $user->assignDefaultTeamRole();
            }
        });
    }

    public function assignTeamRole(string $role, int $clientId): void
    {
        app(PermissionRegistrar::class)->setPermissionsTeamId($clientId);
        $this->assignRole($role);
        app(PermissionRegistrar::class)->setPermissionsTeamId(null);
    }

    public function assignDefaultTeamRole(): void
    {
        $defaultClientId = Client::firstOrCreate(['name' => 'Default'])->id;

        $roleExists = \Spatie\Permission\Models\Role::query()
            ->where('name', 'panel_user')
            ->where('guard_name', 'web')
            ->when(config('permission.teams'), fn($q) => $q->where('client_id', $defaultClientId))
            ->exists();

        if ($roleExists) {
            $this->assignTeamRole('panel_user', $defaultClientId);
            $this->clients()->syncWithoutDetaching([$defaultClientId]); // Optional: make sure user is linked to client
        }
    }
}
