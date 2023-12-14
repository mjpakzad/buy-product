<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum TransactionStatus: int
{
    use InvokableCases;
    use Values;
    use Options;

    case INIT = 0;

    case PAID = 1;

    case FAILED = 2;
}
