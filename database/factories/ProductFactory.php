<?php

namespace Database\Factories;

use App\Enums\ProductStatus;
use App\Models\Image;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->slug(),
            'heading' => fake()->sentence(),
            'content' => fake()->text(),
            'stock' => rand(0, 100),
            'price' => rand(1, 1500),
            'status' => fake()->randomElement(ProductStatus::values()),
        ];
    }
}
