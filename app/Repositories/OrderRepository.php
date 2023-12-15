<?php

namespace App\Repositories;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    /**
     * @return string
     */
    public function getModelName(): string
    {
        return Order::class;
    }

    /**
     * @param Order $order
     * @param array $productsData
     * @return mixed
     */
    public function addProducts(Order $order, array $productsData)
    {
        $order->products()->attach($productsData);
    }

    /**
     * @param $order
     * @return mixed
     */
    public function orderPaid($order)
    {
        return $this->update($order, ['status' => OrderStatus::PAID->value]);
    }
}
