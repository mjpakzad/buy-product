<?php

namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function createSlug($string): string;

    public function findBySlug(string $slug): ?Product;

    public function hasStock(Product $product, int $quantity): bool;

    public function reduceQuantity(Product $product, int $quantity);
}
