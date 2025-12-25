<?php

namespace App\Filament\Resources\Operators\Tables;

use App\Actions\AssignColor;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OperatorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('mnemonic')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('type')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.email')
                    ->label('Email'),
                TextColumn::make('user.phone_number')
                    ->label('Phone Number'),
                TextColumn::make('user.roles.name')
                    ->badge()
                    ->label('Role')
                    ->color(fn (string $state): string => AssignColor::getColor($state)),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Added On')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Date Updated')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
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
}
