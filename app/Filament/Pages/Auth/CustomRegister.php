<?php

namespace App\Filament\Pages\Auth;

use App\Models\Client;
use App\Models\User;
use Filament\Auth\Pages\Register;
use Filament\Forms\Components\Select;
use App\Models\Role;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomRegister extends Register
{
    public static string $layout = 'filament-panels::components.layout.simple';

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

    protected function handleRegistration(array $data): Model
    {
        return DB::transaction(function () use ($data) {

            $defaultClient = Client::find(1);
            if ($defaultClient) {
                setPermissionsTeamId($defaultClient->id);
            }

            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->save();

            if ($defaultClient) {
                $user->clients()->attach($defaultClient);
            }

            setPermissionsTeamId(null);

            return $user;
        });
    }
}
