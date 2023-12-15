<?php

namespace Database\Seeders;

use App\Enums\ProductStatus;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = [
            'heading' => 'Lemser hair spray',
            'slug' => 'lemser-hair-spray',
            'content' => 'Strong hair spray with high fixation and adhesion stabilizes your hair in your favorite model. Lemser Hair Spray, using advanced formulation and high quality ingredients will make your hair look shiny and strengthen the hair stem.',
            'stock' => 10,
            'price' => 10000,
            'status' => ProductStatus::PUBLISHED->value,
        ];
        Product::query()->create($product);
    }
}
