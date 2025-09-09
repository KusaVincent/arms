<?php

namespace App\Filament\ReusableResources;

use App\Helpers\LogHelper;
use App\Traits\HasSanitizedFormData;
use Filament\Resources\Pages\EditRecord;

class EditRecordWithSanitization extends EditRecord
{
    use HasSanitizedFormData;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        LogHelper::info('MutateBeforeUpdate triggered', additionalData: ['data' => $data]);

        return $this->sanitizeInput($data);
    }
}
