<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasCustomSlug;
use App\Traits\Referenceable;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static create()
 *
 * @property mixed $operator
 */
final class User extends Authenticatable implements FilamentUser
{
    use AuthenticationLoggable, HasCustomSlug, HasFactory,HasPanelShield,HasRoles,KeepsDeletedModels,LogsActivity, Notifiable, Referenceable;

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

//    public function getAvatarUrlUrlAttribute(): ?string
//    {
//        return $this->avatar_url
//            ? Storage::disk('public')->url($this->avatar_url)
//            : null;
//    }

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

    public function tenant(): HasOne
    {
        return $this->hasOne(Tenant::class);
    }

    public function operator(): HasOne
    {
        return $this->hasOne(Operator::class);
    }

    public function scopeIsAdmin(Builder $query)
    {
        $query->where('user_type', 'admin');
    }

    #[\Override]
    protected static function booted(): void
    {
        self::saving(function ($user): void {
            if ($user->first_name || $user->last_name) {
                $user->name = trim("{$user->first_name} {$user->last_name}");
            }
        });
    }
}
