<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Illuminate\Support\Str;

class EditProfile extends BaseEditProfile
{
    public function getMaxContentWidth(): Width
    {
        return Width::SixExtraLarge;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->description('Update your profile details.')
                    ->schema([
                        $this->getEmailFormComponent()
                            ->disabled(),
                        TextInput::make('roles')
                            ->disabled()
                            ->formatStateUsing(fn ($record) => $record->roles
                                ->pluck('name')
                                ->map(fn ($role) => Str::title(str_replace('_', ' ', $role)))
                                ->join(', ')
                            ),
                        TextInput::make('first_name')
                            ->required(),
                        TextInput::make('middle_name'),
                        TextInput::make('last_name')
                            ->required(),
                        TextInput::make('phone_number')
                            ->required(),
                        Textarea::make('bio')
                            ->rows(3)
                            ->columnSpanFull(),
                        FileUpload::make('avatar_url')
                            ->label('Profile Picture')
                            ->avatar()
                            ->image()
                            ->imageEditor()
                            ->directory('avatars')
                            ->disk('public'),
                    ])->columns(),
            ]);
    }
}
