<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\MaintenanceStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\DeletedModels\Models\Concerns\KeepsDeletedModels;

final class Maintenance extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, KeepsDeletedModels;

    protected $casts = [
        'status' => MaintenanceStatus::class,
    ];

    protected $attributes = [
        'status' => MaintenanceStatus::PENDING,
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    protected static function boot(): void
    {
        parent::boot();

        Maintenance::saving(function ($maintenance): void {
            if ($maintenance->isDirty('status')) {
                $maintenance->status === MaintenanceStatus::COMPLETED
                    ? $maintenance->completion_date = Carbon::now()
                    : $maintenance->completion_date = null;
            }
        });

        Maintenance::creating(function ($maintenance): void {
            if (is_null($maintenance->request_date)) {
                $maintenance->request_date = Carbon::now();
            }
        });
    }
}
