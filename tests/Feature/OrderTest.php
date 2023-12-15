<?php

namespace Tests\Feature;

use App\Enums\OrderStatus;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_purchase_a_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        Sanctum::actingAs($user);
        $userCredit = $user->credit;

        $response = $this->post(route('orders.store', ['product_slug' => $product->slug, 'content' => 'Purchase test']));

        $this->assertAuthenticated();
        $response->assertSuccessful();

        $this->assertDatabaseHas('orders', ['user_id' => $user->id, 'content' => 'Purchase test', 'status' => OrderStatus::PAID->value]);
        $this->assertDatabaseHas('order_product', ['product_id' => $product->id, 'quantity' => 1, 'amount' => $product->price, 'total_amount' => $product->price]);
        $this->assertDatabaseHas('products', ['stock' => $product->stock - 1]);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'credit' => $userCredit - $product->price]);
    }
}
