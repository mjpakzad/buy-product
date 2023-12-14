<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function orders_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('transactions', [
            'id', 'order_id', 'gateway', 'amount', 'status', 'created_at', 'updated_at',
        ]), 1);
    }

    /** @test */
    public function a_transaction_belongs_to_a_user()
    {
        $transaction1 = Transaction::factory()->create();
        $transaction2 = Transaction::factory()->create();
        $order1 = Order::factory()->create();
        $order2 = Order::factory()->create();

        $transaction1->order()->associate($order1);
        $transaction1->save();

        $transaction2->order()->associate($order2);
        $transaction2->save();

        $this->assertInstanceOf(Order::class, $transaction1->order);
        $this->assertEquals($order1->id, $transaction1->order->id);
        $this->assertNotEquals($order2->id, $transaction1->order->id);

        $this->assertInstanceOf(Order::class, $transaction2->order);
        $this->assertEquals($order2->id, $transaction2->order->id);
        $this->assertNotEquals($order1->id, $transaction2->order->id);
    }
}
