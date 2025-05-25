<?php

namespace App\Filament\Resources\PropertyResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class AmenitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'amenities';

    public function form(Form $form): Form
    {
        return $form
            ->schema([ Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('amenity_name')
                        ->required()
                        ->label('Name'),
                    Forms\Components\MarkdownEditor::make('amenity_description')
                        ->required()
                        ->maxLength(255)
                        ->label('Description'),
                ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('amenity_name')
            ->columns([
                Tables\Columns\TextColumn::make('amenity_name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('amenity_description')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('pivot.created_at')
                    ->label('Added On')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make(),
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
