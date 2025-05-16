<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeaseAgreementResource\Pages;
use App\Filament\Resources\LeaseAgreementResource\RelationManagers;
use App\Models\LeaseAgreement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeaseAgreementResource extends Resource
{
    protected static ?string $model = LeaseAgreement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tenant_id')
                    ->required()
                    ->searchable()
                    ->relationship('tenant', 'first_name'),
                Forms\Components\Select::make('property_id')
                    ->required()
                    ->searchable()
                    ->relationship('property', 'name'),
                Forms\Components\DatePicker::make('lease_start_date')
                    ->date()
                    ->required(),
                Forms\Components\DatePicker::make('lease_end_date')
                    ->date(),
                Forms\Components\TextInput::make('rent_amount')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('deposit_amount')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('lease_term')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tenant.first_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('property.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lease_start_date')
                    ->dateTime()
                    ->searchable(),
                Tables\Columns\TextColumn::make('lease_end_date')
                    ->dateTime()
                    ->searchable(),
                Tables\Columns\TextColumn::make('rent_amount')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deposit_amount')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lease_term')
                    ->searchable(),
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
            'index' => Pages\ListLeaseAgreements::route('/'),
//            'create' => Pages\CreateLeaseAgreement::route('/create'),
//            'edit' => Pages\EditLeaseAgreement::route('/{record}/edit'),
        ];
    }
}
