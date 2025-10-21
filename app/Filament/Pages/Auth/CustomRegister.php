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
        // Wrap the creation and assignment in a database transaction
        return DB::transaction(function () use ($data) {
            // Set the active team ID for Spatie before the user is saved and events are fired
            // You can use a temporary team ID or retrieve it from the session
            // For this scenario, you must find a way to determine the correct client ID
            $defaultClient = Client::find(1);
            if ($defaultClient) {
                // This function sets the team_id for the current context
                setPermissionsTeamId($defaultClient->id);
            }

            // Create the user
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->save();

            // The Filament Shield observer will now have access to the correct team ID
            // and should be able to assign the role successfully.

            // Attach the user to the client using the pivot table
            if ($defaultClient) {
                $user->clients()->attach($defaultClient);
            }

            // Reset the team ID after the operation if necessary
            setPermissionsTeamId(null);

            return $user;
        });
    }
}
