<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaintenanceResource\Pages;
use App\Filament\Resources\MaintenanceResource\RelationManagers;
use App\Models\Maintenance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaintenanceResource extends Resource
{
    protected static ?string $model = Maintenance::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('property_id')
                    ->required()
                    ->searchable()
                    ->relationship('property', 'name'),
                Forms\Components\Select::make('tenant_id')
                    ->required()
                    ->searchable()
                    ->relationship('tenant', 'first_name'),
                Forms\Components\MarkdownEditor::make('description')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->native(false)
                    ->options([
                        'Pending',
                        'In Progress',
                        'Completed',
                    ])
                    ->default('Pending'),
                Forms\Components\DatePicker::make('request_date')
                    ->date()
                    ->required(),
                Forms\Components\DatePicker::make('completion_date')
                    ->date()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('property.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tenant.first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->limit(10),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->color(fn (string $state): string => match ($state){
                        'Completed' => 'success',
                        'In Progress' => 'warning',
                        'Pending' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('request_date')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('completion_date')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListMaintenances::route('/'),
//            'create' => Pages\CreateMaintenance::route('/create'),
//            'edit' => Pages\EditMaintenance::route('/{record}/edit'),
        ];
    }
}
