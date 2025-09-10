<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static create()
 */
final class User extends Authenticatable implements Auditable, FilamentUser
{
    use AuthenticationLoggable, HasFactory, KeepsDeletedModels, Notifiable, AuditableTrait, HasRoles, HasPanelShield;

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
    //    public function getNameAttribute(): string
    //    {
    //        return trim((string) ($this->attributes['name'] ?? ''));
    //    }
}
