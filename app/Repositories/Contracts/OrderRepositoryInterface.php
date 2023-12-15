<?php

namespace App\Repositories\Contracts;

use App\Models\Order;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    public function addProducts(Order $order, array $productsData);

    public function orderPaid($order);
}
