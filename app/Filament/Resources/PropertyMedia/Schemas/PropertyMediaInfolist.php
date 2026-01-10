<?php

namespace App\Filament\Resources\PropertyMedia\Schemas;

use App\Filament\ReusableResources\Common\FilamentHelper;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;
use Filament\Support\Icons\Heroicon;

class PropertyMediaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Property Media Gallery')
                    ->description('Click images to expand. Video is restricted to a modest sidebar preview.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                Group::make([
                                    Section::make('High-Resolution Gallery')
                                        ->icon(Heroicon::Photo)
                                        ->compact()
                                        ->schema([
                                            ImageEntry::make('image_one')
                                                ->label('Primary Listing Image')
                                                ->columnSpanFull()
                                                ->url(fn ($record) => asset('storage/' . $record->image_one), true)
                                                ->extraImgAttributes([
                                                    'class' => 'rounded-xl shadow-lg w-full object-cover aspect-[21/9] cursor-zoom-in',
                                                ]),

                                            Grid::make(2)->schema([
                                                FilamentHelper::getGalleryImage('image_two', 'Interior View 1'),
                                                FilamentHelper::getGalleryImage('image_three', 'Interior View 2'),
                                                FilamentHelper::getGalleryImage('image_four', 'Exterior View 1'),
                                                FilamentHelper::getGalleryImage('image_five', 'Exterior View 2'),
                                            ]),
                                        ]),
                                ])->columnSpan(2),

                                Group::make([
                                    Section::make('Video Promotion')
                                        ->icon(Heroicon::VideoCamera)
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('video')
                                                ->hiddenLabel()
                                                ->html()
                                                ->state(fn ($record) => $record->video
                                                    ? "
                                                    <div class='flex flex-col items-center'>
                                                        <div class='w-full overflow-hidden rounded-lg bg-black shadow-inner ring-1 ring-gray-200 dark:ring-gray-800'>
                                                            <video
                                                                controls
                                                                class='w-full max-h-[160px] block mx-auto object-contain'
                                                            >
                                                                <source src='".asset('storage/'.$record->video)."' type='video/mp4'>
                                                            </video>
                                                        </div>
                                                        <span class='mt-2 text-[9px] font-bold uppercase tracking-widest text-gray-400'>Video Preview</span>
                                                    </div>
                                                    "
                                                    : "<div class='py-8 text-center border border-dashed rounded-lg text-gray-400 text-[10px] uppercase tracking-widest'>No Video Uploaded</div>"
                                                ),
                                        ]),

                                    Section::make('Audit Trail')
                                        ->icon(Heroicon::FingerPrint)
                                        ->compact()
                                        ->schema([
                                            TextEntry::make('created_at')->label('Uploaded')->dateTime('M j, Y'),
                                            TextEntry::make('updated_at')->label('Activity')->since()->size(TextSize::Small),
                                        ]),
                                ])->columnSpan(1),
                            ]),
                    ]),
            ]);
    }
}
