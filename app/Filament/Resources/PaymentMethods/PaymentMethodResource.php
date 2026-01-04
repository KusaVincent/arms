<?php

namespace App\Filament\Resources\PaymentMethods;

use AlizHarb\ActivityLog\RelationManagers\ActivitiesRelationManager;
use App\Filament\Resources\PaymentMethods\Pages\CreatePaymentMethod;
use App\Filament\Resources\PaymentMethods\Pages\EditPaymentMethod;
use App\Filament\Resources\PaymentMethods\Pages\ListPaymentMethods;
use App\Filament\Resources\PaymentMethods\RelationManagers\PaymentsRelationManager;
use App\Filament\Resources\PaymentMethods\Schemas\PaymentMethodForm;
use App\Filament\Resources\PaymentMethods\Tables\PaymentMethodTable;
use App\Models\PaymentMethod;
use App\Traits\HasSharedResourceProperties;
use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class PaymentMethodResource extends Resource
{
    use HasSharedResourceProperties;

    protected static ?string $model = PaymentMethod::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static string|null|\UnitEnum $navigationGroup = 'Payments';

    /**
     * @throws Exception
     */
    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return PaymentMethodForm::configure($schema);
    }

    /**
     * @throws Exception
     */
    #[\Override]
    public static function table(Table $table): Table
    {
        return PaymentMethodTable::configure($table)
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
            PaymentsRelationManager::class,
            ActivitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPaymentMethods::route('/'),
            'create' => CreatePaymentMethod::route('/create'),
            'edit' => EditPaymentMethod::route('/{record}/edit'),
        ];
    }
}
