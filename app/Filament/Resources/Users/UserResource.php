<?php

namespace App\Filament\Resources\Users;

use AlizHarb\ActivityLog\RelationManagers\ActivitiesRelationManager;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\ReusableResources\ResourceForm\UserForm;
use App\Filament\ReusableResources\ResourceTable\UserTable;
use App\Models\User;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Tapp\FilamentAuthenticationLog\RelationManagers\AuthenticationLogsRelationManager;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'User Management';

    protected static string|null|BackedEnum $navigationIcon = Heroicon::User;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::isAdmin()->count();
    }

    /**
     * @throws \Exception
     */
    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return UserForm::form($schema);
    }

    /**
     * @throws \Exception
     */
    #[\Override]
    public static function table(Table $table): Table
    {
        return UserTable::columns($table)
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->isAdmin();
    }

    #[\Override]
    public static function getRelations(): array
    {
        return [
            AuthenticationLogsRelationManager::class,
            ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
