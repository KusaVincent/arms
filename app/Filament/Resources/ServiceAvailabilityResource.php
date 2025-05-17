<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceAvailabilityResource\Pages;
use App\Filament\Resources\ServiceAvailabilityResource\RelationManagers;
use App\Models\ServiceAvailability;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceAvailabilityResource extends Resource
{
    protected static ?string $model = ServiceAvailability::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('service_name')
                    ->required(),
                Forms\Components\TextInput::make('service_key')
                    ->required(),
                Forms\Components\Select::make('is_active')
                    ->required()
                    ->options([
                        true => 'Yes',
                        false => 'No',
                    ])
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service_name'),
                Tables\Columns\TextColumn::make('service_key'),
                Tables\Columns\TextColumn::make('is_active')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state): string => intval($state) ? 'Yes' : 'No')
                    ->color(fn ($state): string => intval($state) ? 'success' : 'warning'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
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
            'create' => Pages\CreateServiceAvailability::route('/create'),
            'edit' => Pages\EditServiceAvailability::route('/{record}/edit'),
        ];
    }
}
