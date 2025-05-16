<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Founder;
use Illuminate\Database\Seeder;

final class FounderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $founders = [
            [
                'name' => 'Libby Ngina',
                'image' => '/assets/img/avatar/libby.jpg',
                'social_media' => [
                    ['icon' => 'fa-facebook', 'url' => '#', 'hoverClass' => 'hover:text-blue-500'],
                    ['icon' => 'fa-twitter', 'url' => '#', 'hoverClass' => 'hover:text-blue-400'],
                    ['icon' => 'fa-linkedin', 'url' => '#', 'hoverClass' => 'hover:text-blue-700'],
                ],
            ],
            [
                'name' => 'Vincent Kusa',
                'image' => '/assets/img/avatar/kusa.jpg',
                'social_media' => [
                    ['icon' => 'fa-facebook', 'url' => '#', 'hoverClass' => 'hover:text-blue-500'],
                    ['icon' => 'fa-twitter', 'url' => '#', 'hoverClass' => 'hover:text-blue-400'],
                    ['icon' => 'fa-linkedin', 'url' => '#', 'hoverClass' => 'hover:text-blue-700'],
                ],
            ],
            [
                'name' => 'Dominic Mputa',
                'image' => '/assets/img/avatar/dom.jpg',
                'social_media' => [
                    ['icon' => 'fa-facebook', 'url' => '#', 'hoverClass' => 'hover:text-blue-500'],
                    ['icon' => 'fa-twitter', 'url' => '#', 'hoverClass' => 'hover:text-blue-400'],
                    ['icon' => 'fa-linkedin', 'url' => '#', 'hoverClass' => 'hover:text-blue-700'],
                ],
            ],
            [
                'name' => 'Patrick Ayub',
                'image' => '/assets/img/avatar/pat.jpg',
                'social_media' => [
                    ['icon' => 'fa-facebook', 'url' => '#', 'hoverClass' => 'hover:text-blue-500'],
                    ['icon' => 'fa-twitter', 'url' => '#', 'hoverClass' => 'hover:text-blue-400'],
                    ['icon' => 'fa-linkedin', 'url' => 'https://www.youtube.com/watch?v=3RI-sR3isJM', 'hoverClass' => 'hover:text-blue-700'],
                ],
            ],
        ];

        foreach ($founders as $founder) {
            Founder::create($founder);
        }
    }
}
