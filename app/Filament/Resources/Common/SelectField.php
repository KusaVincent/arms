<?php

namespace App\Filament\Resources\Common;

use Filament\Forms\Components\Select;

class SelectField
{
    public static function make(string $field): Select
    {
        return Select::make($field)
            ->preload()
            ->searchable()
            ->loadingMessage(__('Loading...'))
            ->placeholder(__('Select an option'))
            ->searchPrompt(__('Start typing to search...'))
            ->noSearchResultsMessage(__('No options match your search.'));
    }
}
