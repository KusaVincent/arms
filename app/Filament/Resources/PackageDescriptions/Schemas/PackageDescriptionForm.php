<?php

namespace App\Filament\Resources\PackageDescriptions\Schemas;

use App\Enums\PackagePublished;
use App\Enums\PackageStatus;
use App\Filament\ReusableResources\Common\SelectField;
use App\Support\SanitizationHelper;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
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
                    ->formatStateUsing(fn ($state, $livewire) => $livewire instanceof EditRecord
                        ? SanitizationHelper::stripFormatting($state)
                        : $state
                    ),
                TextInput::make('annual_package_price')
                    ->required()
                    ->formatStateUsing(fn ($state, $livewire) => $livewire instanceof EditRecord
                        ? SanitizationHelper::stripFormatting($state)
                        : $state
                    ),
                SelectField::default('status')
                    ->options(PackageStatus::class)
                    ->required(),
                SelectField::default('published')
                    ->options(PackagePublished::class)
                    ->required(),
                DateTimePicker::make('published_from'),
                DateTimePicker::make('published_until'),
                MarkdownEditor::make('description')
                    ->required(),
            ]);
    }
}
