<?php

namespace App\Filament\Resources\PackageDescriptions\Schemas;

use App\Enums\PackagePublished;
use App\Enums\PackageStatus;
use App\Filament\ReusableResources\Common\MoneyField;
use App\Filament\ReusableResources\Common\SelectField;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PackageDescriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Package Details')
                    ->columns()
                    ->schema([
                        TextInput::make('name')
                            ->required(),

                        Grid::make()->schema([
                            MoneyField::make('monthly_package_price'),
                            MoneyField::make('annual_package_price'),
                        ]),

                        SelectField::default('status')
                            ->options(PackageStatus::class)
                            ->required(),

                        SelectField::default('published')
                            ->options(PackagePublished::class)
                            ->required(),

                        DateTimePicker::make('published_from'),
                        DateTimePicker::make('published_until'),

                        MarkdownEditor::make('description')
                            ->columnSpanFull()
                            ->required(),
                    ]),

                Section::make('Audit Information')
                    ->columns(2)
                    ->schema([
                        DateTimePicker::make('created_at')
                            ->label('Created At')
                            ->disabled()
                            ->dehydrated(false)
                            ->visible(fn ($livewire) => $livewire instanceof EditRecord),

                        DateTimePicker::make('updated_at')
                            ->label('Last Updated')
                            ->disabled()
                            ->dehydrated(false)
                            ->visible(fn ($livewire) => $livewire instanceof EditRecord),
                    ])
            ]);
    }
}
