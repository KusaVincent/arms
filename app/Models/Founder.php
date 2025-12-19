<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @method static create(array $founder)
 */
final class Founder extends Model
{
    use HasFactory, LogsActivity, Referenceable, softDeletes;

    protected string $referencePrefix = 'FND';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }

    protected $casts = [
        'social_media' => 'json:unicode',
    ];
}
