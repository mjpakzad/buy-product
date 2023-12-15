<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return Product::class;
    }

    public function createSlug($string): string
    {
        return str_replace(' ', '-', $string) . '-' . uniqid(auth()->id());
    }

    public function findBySlug(string $slug): ?Product
    {
        return $this->getModel()->query()->where('slug', $slug)->first();
    }

    public function hasStock(Product $product, int $quantity = 1): bool
    {
        return $product->stock >= $quantity;
    }

    /**
     * @param Product $product
     * @param int $quantity
     * @return mixed
     */
    public function reduceQuantity(Product $product, int $quantity)
    {
        $product->decrement('stock', $quantity);
        return $product->refresh();
    }
}
