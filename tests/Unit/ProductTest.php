<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function products_table_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('products', [
            'id', 'heading', 'slug', 'content', 'stock', 'price', 'status', 'created_at', 'updated_at',
        ]), 1);
    }

    /** @test */
    public function it_uses_the_correct_route_key_name()
    {
        $product = new Product();
        $this->assertEquals('slug', $product->getRouteKeyName());
    }

    /** @test  */
    public function a_product_belongs_to_many_orders()
    {
        $order = Order::factory()->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $order->products);
    }
}
