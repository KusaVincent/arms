<?php

namespace App\Traits;

use MohamedSaid\Referenceable\Traits\HasReference;

trait Referenceable
{
    use HasReference;

    protected string $referenceColumn = 'mnemonic';

    protected string $referenceStrategy = 'template';

    protected array $referenceTemplate = [
        'format' => '{PREFIX}{YEAR2}{MONTH}{DAY}{SEQ}{RANDOM}',
        'sequence_length' => 4,
    ];
}
