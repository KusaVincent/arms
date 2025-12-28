<?php

namespace App\Filament\Resources\Operators\Pages;

use App\Filament\Resources\Operators\OperatorResource;
use App\Traits\HandleRecordCreation;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateOperator extends CreateRecord
{
    use HandleRecordCreation;

    protected static string $resource = OperatorResource::class;

    public function handleRecordCreation(array $data): Model
    {
        $this->userType = 'operator';

        return $this->handle($data);
    }
}
