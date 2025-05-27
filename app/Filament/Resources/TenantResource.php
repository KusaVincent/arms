<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenantResource\Pages;
use App\Filament\Resources\TenantResource\RelationManagers\LeaseAgreementRelationManager;
use App\Filament\Resources\TenantResource\RelationManagers\MaintenanceRelationManager;
use App\Filament\ReusableResources\ReusableTenantResource;
use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('first_name')
                                    ->required(),
                                Forms\Components\TextInput::make('middle_name'),
                                Forms\Components\TextInput::make('last_name')
                                    ->required(),
                            ])->columns(3),
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                Forms\Components\TextInput::make('phone')
                                    ->tel()
                                    ->required(),
                                Forms\Components\TextInput::make('password')
                                    ->visible(fn ($livewire): bool => $livewire instanceof CreateRecord)
                                    ->password()
                                    ->required()
                                    ->confirmed(),
                                Forms\Components\TextInput::make('password_confirmation')
                                    ->visible(fn ($livewire): bool => $livewire instanceof CreateRecord)
                                    ->password()
                                    ->required()
                                    ->dehydrated(false),
                            ])->columns(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return ReusableTenantResource::columns($table)
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            LeaseAgreementRelationManager::class,
            MaintenanceRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTenants::route('/'),
            'create' => Pages\CreateTenant::route('/create'),
            'edit' => Pages\EditTenant::route('/{record}/edit'),
        ];
    }
}
