<?php

namespace App\Filament\Resources\CustomerSupports;

use App\Filament\Resources\CustomerSupports\Pages\CreateCustomerSupport;
use App\Filament\Resources\CustomerSupports\Pages\EditCustomerSupport;
use App\Filament\Resources\CustomerSupports\Pages\ListCustomerSupports;
use App\Filament\ReusableResources\ResourceForm\CustomerSupportForm;
use App\Filament\ReusableResources\ResourceTable\CustomerSupportTable;
use App\Models\CustomerSupport;
use BackedEnum;
use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Tapp\FilamentAuditing\RelationManagers\AuditsRelationManager;

class CustomerSupportResource extends Resource
{
    protected static ?string $model = CustomerSupport::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    /**
     * @throws Exception
     */
    public static function form(Schema $schema): Schema
    {
        return CustomerSupportForm::form($schema);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return CustomerSupportTable::columns($table)
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AuditsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCustomerSupports::route('/'),
            'create' => CreateCustomerSupport::route('/create'),
            'edit' => EditCustomerSupport::route('/{record}/edit'),
        ];
    }
}
