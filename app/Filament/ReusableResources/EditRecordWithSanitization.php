<?php

namespace App\Filament\ReusableResources;

use App\Traits\HasSanitizedFormData;
use Filament\Resources\Pages\EditRecord;

class EditRecordWithSanitization extends EditRecord
{
    use HasSanitizedFormData;

    protected function mutateFormDataBeforeSave(array $data): array
    {\Log::info('MutateBeforeCreate triggered', compact('data'));
        return $this->sanitizeInput($data);
    }
}
