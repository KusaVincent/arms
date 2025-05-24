<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ContactSection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static whereNot(string $string, string $string1)
 * @method static create(string[] $contact)
 */
final class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'section' => ContactSection::class,
    ];

    protected $attributes = [
        'section' => ContactSection::ALL,
    ];
}
