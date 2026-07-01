<?php

namespace App\Services;

use App\Events\CartCleared;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(protected CartService $cartService) {}

    public function store($data, Cart $cart)
    {
        return DB::transaction(function () use ($data, $cart) {

            $items = $this->cartService->getCartItems($cart);
            $order =  Order::create([
                'user_id' => Auth::id(),
                'payment_method' => 'Stripe',
            ]);
            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                ]);
            }
            foreach ($data['addr'] as $type => $address) {
                $address['type'] = $type;
                $order->addresses()->create($address);
            }
            event(new CartCleared());

            return $order;
        });
    }
}
