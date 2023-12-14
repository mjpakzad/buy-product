<?php

namespace Tests\Unit;

use App\Enums\TransactionGateway;
use Tests\TestCase;

class TransactionGatewayTest extends TestCase
{
    /** @test */
    public function transaction_has_expected_gateways(): void
    {
        $statuses = [
            'CREDIT' => 1,
            'MELLAT' => 2,
            'ZARINPAL' => 3,
            'PAYLINE' => 4,
            'JAHANPAY' => 5,
            'PARSIAN' => 6,
            'PASARGAD' => 7,
            'SAMAN' => 8,
            'ASANPARDAKHT' => 9,
            'PAYPAL' => 10,
            'PAYIR' => 11,
            'SADAD' => 14,
        ];
        $this->assertEquals($statuses, TransactionGateway::options());
    }
}
