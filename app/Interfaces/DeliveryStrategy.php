<?php

namespace App\Interfaces;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface DeliveryStrategy
{

    public function createOrder(Order $order);

    /**
     * Get the details of one or multiple packages
     *
     * @param array|Collection $packages
     * @return bool
     */
    public function getOrders(array|Collection $orders);

    public function getPricing();

}
