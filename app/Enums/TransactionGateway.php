<?php

namespace App\Enums;

use App\Enums\Traits\SwapTrait;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum TransactionGateway: int
{
    use InvokableCases;
    use Values;
    use Options;
    use SwapTrait;

    case CREDIT = 1;

    case MELLAT = 2;

    case ZARINPAL = 3;

    case PAYLINE = 4;

    case JAHANPAY = 5;

    case PARSIAN = 6;

    case PASARGAD = 7;

    case SAMAN = 8;

    case ASANPARDAKHT = 9;

    case PAYPAL = 10;

    case PAYIR = 11;

    case SADAD = 12;
}
