<?php

namespace Database\Factories;

use App\Enums\TransactionGateway;
use App\Enums\TransactionStatus;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory()->create()->id,
            'gateway' => fake()->numberBetween(TransactionGateway::CREDIT->value, TransactionGateway::SADAD->value),
            'amount' => fake()->randomDigit(),
            'status' => fake()->numberBetween(TransactionStatus::PAID->value, TransactionStatus::FAILED->value),
        ];
    }
}
