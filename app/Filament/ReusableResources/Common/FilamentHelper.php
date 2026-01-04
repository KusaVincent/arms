<?php

namespace App\Filament\ReusableResources\Common;

use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Schema;

class FilamentHelper
{
    public static function getOperation(Schema $schema): string
    {
        return $schema->getLivewire() instanceof CreateRecord
            ? 'create'
            : 'edit';
    }
}
