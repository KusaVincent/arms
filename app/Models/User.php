<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasCustomSlug;
use App\Traits\Referenceable;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static create()
 */
final class User extends Authenticatable implements FilamentUser
{
    use AuthenticationLoggable, HasFactory, HasPanelShield,HasRoles,KeepsDeletedModels,LogsActivity,Notifiable, Referenceable, HasCustomSlug;

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

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    public function subscriptionPackages(): HasMany
    {
        return $this->hasMany(SubscriptionPackage::class);
    }

    public function tenant(): HasOne
    {
        return $this->hasOne(Tenant::class);
    }

    public function operator(): HasOne
    {
        return $this->hasOne(Operator::class);
    }

    protected static function booted(): void
    {
        static::saving(function ($user) {
            if ($user->first_name || $user->last_name) {
                $user->name = trim("{$user->first_name} {$user->last_name}");
            }
        });

//        static::created(function ($user) {
//            $user->assignRole('panel_user');
//        });
//
//        static::saved(function ($user) {
//            if (! $user->hasRole('panel_user')) {
//                $user->assignRole('panel_user');
//            }
//        });
    }
}
