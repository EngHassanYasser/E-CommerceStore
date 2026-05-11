<?php

namespace App\Repositories\Order;

use App\Models\Cart;
use App\Models\Order;
use App\Repositories\Base\BaseRepository;

interface OrderRepository extends BaseRepository
{
    public function StoreOrder($user_id, $data, Cart $cart);
    public function storeOrderItems($order_id,$items);
    public function storeOrderAddresses(Order $order,$data);
}
