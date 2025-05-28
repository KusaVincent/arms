<?php

namespace App\Filament\Resources\PropertyResource\RelationManagers;

use App\Filament\ReusableResources\ReusableAmenityResource;
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
            ->schema([Forms\Components\Section::make()
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
        return ReusableAmenityResource::columns($table)
            ->recordTitleAttribute('amenity_name')
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
