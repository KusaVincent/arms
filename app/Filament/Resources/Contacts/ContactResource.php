<?php

namespace App\Filament\Resources\Contacts;

use AlizHarb\ActivityLog\RelationManagers\ActivitiesRelationManager;
use App\Filament\Resources\Contacts\Pages\CreateContact;
use App\Filament\Resources\Contacts\Pages\EditContact;
use App\Filament\Resources\Contacts\Pages\ListContacts;
use App\Filament\ReusableResources\ResourceForm\ContactForm;
use App\Filament\ReusableResources\ResourceTable\ContactTable;
use App\Models\Contact;
use App\Traits\HasSharedResourceProperties;
use Exception;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    use HasSharedResourceProperties;

    protected static ?string $model = Contact::class;

    protected static ?string $recordTitleAttribute = 'label';

    protected static string|null|\UnitEnum $navigationGroup = 'Settings';

    /**
     * @throws Exception
     */
    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return ContactForm::form($schema);
    }

    /**
     * @throws Exception
     */
    #[\Override]
    public static function table(Table $table): Table
    {
        return ContactTable::columns($table)
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
            'index' => ListContacts::route('/'),
            'create' => CreateContact::route('/create'),
            'edit' => EditContact::route('/{record}/edit'),
        ];
    }
}
