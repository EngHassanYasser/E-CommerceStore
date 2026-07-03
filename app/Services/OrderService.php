<?php

namespace App\Services;

use App\Events\CartCleared;
use App\Exceptions\InvalidOrderException;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(protected CartService $cartService) {}

    public function store($data)
    {
        return DB::transaction(function () use ($data) {

            $cart = $this->cartService->getCart();
            if (!$cart || $cart->items->isEmpty()) {
                throw new InvalidOrderException('Cart is empty');
            }

            $order =  Order::create([
                'user_id' => Auth::id(),
                'payment_method' => 'Stripe',
            ]);
            $items = [];

            foreach ($cart->items as $item) {
                $items[] = [
                    'product_id'   => $item->product_id,
                    'product_name' => $item->product->name,
                    'price'        => $item->product->price,
                    'quantity'     => $item->quantity,
                ];
            }

            $order->items()->createMany($items);
            $addresses = [];

            foreach ($data['addr'] as $type => $address) {
                $address['type'] = $type;
                $addresses[] = $address;
            }

            $order->addresses()->createMany($addresses);
            event(new CartCleared(Auth::user()));

            return $order;
        });
    }
}
