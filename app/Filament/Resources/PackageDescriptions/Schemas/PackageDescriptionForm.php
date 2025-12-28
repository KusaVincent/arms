<?php

namespace App\Filament\Resources\PackageDescriptions\Schemas;

use App\Enums\PackagePublished;
use App\Enums\PackageStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PackageDescriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('monthly_package_price')
                    ->required()
                    ->numeric(),
                TextInput::make('annual_package_price')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options(PackageStatus::class)
                    ->required(),
                Select::make('published')
                    ->options(PackagePublished::class)
                    ->required(),
                DateTimePicker::make('published_from'),
                DateTimePicker::make('published_until'),
                MarkdownEditor::make('description')
                    ->required(),
            ]);
    }
}
