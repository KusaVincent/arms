<?php

namespace App\Filament\Resources\Abouts;

use AlizHarb\ActivityLog\RelationManagers\ActivitiesRelationManager;
use App\Filament\Resources\Abouts\Pages\CreateAbout;
use App\Filament\Resources\Abouts\Pages\EditAbout;
use App\Filament\Resources\Abouts\Pages\ListAbouts;
use App\Filament\Resources\Abouts\Pages\ViewAbout;
use App\Filament\Resources\Abouts\Schemas\AboutForm;
use App\Filament\Resources\Abouts\Schemas\AboutInfolist;
use App\Filament\Resources\Abouts\Tables\AboutTable;
use App\Models\About;
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

class AboutResource extends Resource
{
    use HasSharedResourceProperties;

    protected static ?string $model = About::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static string|null|\UnitEnum $navigationGroup = 'Settings';

    /**
     * @throws Exception
     */
    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return AboutForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AboutInfolist::configure($schema);
    }

    /**
     * @throws Exception
     */
    #[\Override]
    public static function table(Table $table): Table
    {
        return AboutTable::configure($table)
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
            'index' => ListAbouts::route('/'),
            'create' => CreateAbout::route('/create'),
            'view' => ViewAbout::route('/{record}'),
            'edit' => EditAbout::route('/{record}/edit'),
        ];
    }
}
