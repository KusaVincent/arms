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
 * @method static create(string[] $array)
 */
final class About extends Model
{
    use HasFactory, LogsActivity, Referenceable, softDeletes;

    protected string $referencePrefix = 'ABT';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll();
    }
}
