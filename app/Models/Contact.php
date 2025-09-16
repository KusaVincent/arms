<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ContactSection;
use App\Traits\Referenceable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use \OwenIt\Auditing\Auditable as AuditableTrait;

/**
 * @method static whereNot(string $string, string $string1)
 * @method static create(string[] $contact)
 */
final class Contact extends Model implements Auditable
{
    use HasFactory, SoftDeletes, AuditableTrait, Referenceable;

    protected string $referencePrefix = 'CON';

    protected $casts = [
        'section' => ContactSection::class,
    ];

    protected $attributes = [
        'section' => ContactSection::ALL,
    ];
}
