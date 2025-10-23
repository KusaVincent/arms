<?php

namespace App\Filament\Pages\Auth;

use App\Services\UserService;
use Filament\Auth\Pages\Register;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;

class CustomRegister extends Register
{
    public static string $layout = 'filament-panels::components.layout.simple';

    #[\Override]
    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }

    /**
     * @throws \Throwable
     */
    #[\Override]
    protected function handleRegistration(array $data): Model
    {
        $userService = app(UserService::class);

        return $userService->createWithDefaultRole($data);
    }
}
