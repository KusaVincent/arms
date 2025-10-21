<?php

namespace App\Filament\ReusableResources;

use App\Helpers\LogHelper;
use App\Traits\HasSanitizedFormData;
use Filament\Resources\Pages\CreateRecord;

class CreateRecordWithSanitization extends CreateRecord
{
    use HasSanitizedFormData;

    #[\Override]
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        LogHelper::info('MutateBeforeCreate triggered', additionalData: ['data' => $data]);

        return $this->sanitizeInput($data);
    }
}
