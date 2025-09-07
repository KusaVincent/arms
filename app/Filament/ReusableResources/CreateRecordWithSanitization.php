<?php

namespace App\Filament\ReusableResources;

use App\Traits\HasSanitizedFormData;
use Filament\Resources\Pages\CreateRecord;

class CreateRecordWithSanitization extends CreateRecord
{
    use HasSanitizedFormData;

    protected function mutateFormDataBeforeCreate(array $data): array
    {\Log::info('MutateBeforeCreate triggered', compact('data'));
        return $this->sanitizeInput($data);
    }
}
