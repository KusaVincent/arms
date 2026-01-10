<?php

namespace App\Filament\ReusableResources\Common;

use Filament\Infolists\Components\ImageEntry;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Schema;

class FilamentHelper
{
    public static function getOperation(Schema $schema): string
    {
        return $schema->getLivewire() instanceof CreateRecord
            ? 'create'
            : 'edit';
    }

    public static function getGalleryImage(string $name, string $label): ImageEntry
    {
        return ImageEntry::make($name)
            ->label($label)
            ->url(fn ($record) => $record->$name ? asset('storage/' . $record->$name) : null, true)
            ->extraImgAttributes([
                'class' => 'rounded-lg shadow-sm w-full object-cover aspect-video cursor-zoom-in hover:scale-[1.01] transition-transform duration-200',
            ]);
    }
}
