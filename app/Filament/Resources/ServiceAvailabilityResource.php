<?php

namespace App\Filament\Resources;

use App\Enums\ActiveServiceAvailability;
use App\Filament\Resources\ServiceAvailabilityResource\Pages;
use App\Models\ServiceAvailability;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceAvailabilityResource extends Resource
{
    protected static ?string $model = ServiceAvailability::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('service_name')
                            ->required()
                            ->label('Service Name'),
                        Forms\Components\Section::make()
                            ->description('This field is what is used by the system to check if service is active or not')
                            ->schema([
                                Forms\Components\TextInput::make('service_key')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->label('Service Key'),
                            ]),
                        Forms\Components\Select::make('is_active')
                            ->label('Active')
                            ->default(ActiveServiceAvailability::NO)
                            ->options(ActiveServiceAvailability::class),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service_name')
                    ->label('Service'),
                Tables\Columns\TextColumn::make('service_key')
                    ->label('Key'),
                Tables\Columns\TextColumn::make('is_active')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->label('Active'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Added On')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Date Updated')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceAvailabilities::route('/'),
//            'create' => Pages\CreateServiceAvailability::route('/create'),
//            'edit' => Pages\EditServiceAvailability::route('/{record}/edit'),
        ];
    }
}
