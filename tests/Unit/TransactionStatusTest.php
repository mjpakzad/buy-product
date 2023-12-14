<?php

namespace Tests\Unit;

use App\Enums\TransactionStatus;
use Tests\TestCase;

class TransactionStatusTest extends TestCase
{
    /** @test */
    public function transaction_has_expected_statuses(): void
    {
        $statuses = [
            'INIT' => 0,
            'PAID' => 1,
            'FAILED' => 2,
        ];
        $this->assertEquals($statuses, TransactionStatus::options());
    }
}
