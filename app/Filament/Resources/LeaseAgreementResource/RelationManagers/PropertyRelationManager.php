<?php

namespace App\Filament\Resources\LeaseAgreementResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropertyRelationManager extends RelationManager
{
    protected static string $relationship = 'property';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('property_image')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('propertyType.type_name')
                    ->searchable()
                    ->label('Property Type'),
                Tables\Columns\TextColumn::make('rent')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('deposit')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('available')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->label('Availability'),
                Tables\Columns\TextColumn::make('negotiable')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('location.location_summary')
                    ->limit(20)
                    ->label('Location')
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ->headerActions([
//                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
