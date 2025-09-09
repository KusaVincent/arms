<?php

namespace App\Filament\Resources\Abouts\Pages;

use App\Filament\Resources\Abouts\AboutResource;
use App\Filament\ReusableResources\EditRecordWithSanitization;
use App\Traits\HasSanitizedFormData;
use Filament\Actions\DeleteAction;

class EditAbout extends EditRecordWithSanitization
{
    use HasSanitizedFormData;

    protected static string $resource = AboutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
