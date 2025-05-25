<?php

namespace App\Filament\Resources;

use App\Enums\ContactSection;
use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Section::make('')
                            ->schema([
                                Forms\Components\TextInput::make('label')
                                    ->required(),
                                Forms\Components\TextInput::make('icon')
                                    ->required(),
                            ])->columns(),
                        Forms\Components\Section::make('')
                            ->schema([
                                Forms\Components\TextInput::make('link')
                                    ->required(),
                                Forms\Components\TextInput::make('link_text')
                                    ->required()
                                    ->label('Link Text'),
                            ])->columns(),
                        Forms\Components\Section::make('')
                            ->schema([
                                Forms\Components\Select::make('section')
                                    ->native(false)
                                    ->default(ContactSection::ALL)
                                    ->options(ContactSection::class),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('icon')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('link')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('link_text')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('section')
                    ->badge()
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
