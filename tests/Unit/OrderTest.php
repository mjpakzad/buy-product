<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function orders_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('orders', [
            'id', 'user_id', 'content', 'status', 'total_amount', 'created_at', 'updated_at',
        ]), 1);
    }

    /** @test */
    public function an_order_belongs_to_a_user()
    {
        $order1 = Order::factory()->create();
        $order2 = Order::factory()->create();
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $order1->user()->associate($user1);
        $order1->save();

        $order2->user()->associate($user2);
        $order2->save();

        $this->assertInstanceOf(User::class, $order1->user);
        $this->assertEquals($user1->id, $order1->user->id);
        $this->assertNotEquals($user2->id, $order1->user->id);

        $this->assertInstanceOf(User::class, $order2->user);
        $this->assertEquals($user2->id, $order2->user->id);
        $this->assertNotEquals($user1->id, $order2->user->id);
    }

    /** @test */
    public function an_order_has_many_transactions()
    {
        $order1 = Order::factory()->create();
        $order2 = Order::factory()->create();
        $transaction1 = Transaction::factory()->create(['order_id' => $order1->id]);
        $transaction2 = Transaction::factory()->create(['order_id' => $order1->id]);
        $transaction3 = Transaction::factory()->create(['order_id' => $order2->id]);

        $order1Transactions = $order1->transactions;
        $order2Transactions = $order2->transactions;

        $this->assertInstanceOf(Transaction::class, $order1Transactions->first());
        $this->assertCount(2, $order1Transactions);
        $this->assertTrue($order1Transactions->contains($transaction1));
        $this->assertTrue($order1Transactions->contains($transaction2));
        $this->assertFalse($order1Transactions->contains($transaction3));

        $this->assertInstanceOf(Transaction::class, $order2Transactions->first());
        $this->assertCount(1, $order2Transactions);
        $this->assertTrue($order2Transactions->contains($transaction3));
    }

    /** @test  */
    public function an_order_belongs_to_many_products()
    {
        $order = Order::factory()->create();
        $product = Product::factory()->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $product->orders);
    }
}
