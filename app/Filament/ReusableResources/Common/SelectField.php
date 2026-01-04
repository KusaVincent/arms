<?php

namespace App\Filament\ReusableResources\Common;

use Filament\Forms\Components\Select;

class SelectField
{
    public static function make(string $field): Select
    {
        return static::default($field)
            ->preload()
            ->searchable();
    }

    public static function default(string $field): Select
    {
        return Select::make($field)
            ->loadingMessage(__('Loading...'))
            ->placeholder(__('Select an option'))
            ->searchPrompt(__('Start typing to search...'))
            ->noSearchResultsMessage(__('No options match your search.'));
    }
}
