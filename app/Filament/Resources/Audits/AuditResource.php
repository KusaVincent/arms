<?php

namespace App\Filament\Resources\Audits;

use Filament\Resources\Resource;
use OwenIt\Auditing\Models\Audit;

class AuditResource extends Resource
{
    protected static ?string $model = Audit::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAudits::route('/'),
        ];
    }
}
