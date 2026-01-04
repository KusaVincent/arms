<?php

namespace App\Filament\Resources\CustomerSupports;

use AlizHarb\ActivityLog\RelationManagers\ActivitiesRelationManager;
use App\Filament\Resources\CustomerSupports\Pages\CreateCustomerSupport;
use App\Filament\Resources\CustomerSupports\Pages\EditCustomerSupport;
use App\Filament\Resources\CustomerSupports\Pages\ListCustomerSupports;
use App\Filament\Resources\CustomerSupports\Schemas\CustomerSupportForm;
use App\Filament\Resources\CustomerSupports\Tables\CustomerSupportTable;
use App\Models\CustomerSupport;
use App\Traits\HasSharedResourceProperties;
use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class CustomerSupportResource extends Resource
{
    use HasSharedResourceProperties;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'email';

    protected static ?string $model = CustomerSupport::class;

    protected static ?string $navigationLabel = 'Secure Messages';

    protected static string|null|\UnitEnum $navigationGroup = 'Customer Management';

    /**
     * @throws Exception
     */
    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return CustomerSupportForm::configure($schema);
    }

    /**
     * @throws Exception
     */
    #[\Override]
    public static function table(Table $table): Table
    {
        return CustomerSupportTable::configure($table)
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

    #[\Override]
    public static function getRelations(): array
    {
        return [
            ActivitiesRelationManager::class,
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
