<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class OrderProductTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function orders_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('order_product', [
            'order_id', 'product_id', 'quantity', 'amount', 'total_amount',
        ]), 1);
    }
}
