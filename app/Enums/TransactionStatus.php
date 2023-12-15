<?php

namespace App\Enums;

use App\Enums\Traits\SwapTrait;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum TransactionStatus: int
{
    use InvokableCases;
    use Values;
    use Options;
    use SwapTrait;

    case INIT = 0;

    case PAID = 1;

    case FAILED = 2;
}
