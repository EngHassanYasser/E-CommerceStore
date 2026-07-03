<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function getCart()
    {
        return Auth::user()->cart()->with(['items','items.product'])->first();
    }
    public function store(array $data)
    {
        DB::transaction(function () use ($data) {

            $product = Product::whereKey($data['product_id'])
                ->where('quantity', '>=', $data['quantity'])
                ->firstOrFail();

            $cart = Auth::user()->cart;

            $item = $cart->items()
                ->where('product_id', $product->id)
                ->first();

            if ($item) {
                $item->increment('quantity', $data['quantity']);
            } else {
                $cart->items()->create([
                    'product_id' => $product->id,
                    'quantity'   => $data['quantity'],
                    'price'      => $product->price,
                ]);
            }
        });
    }
    public function total()
    {
        return (float) Auth::user()->cart->items->sum(function ($item) {
            return $item->quantity * $item->price;
        });
    }
    public function update($id, $data)
    {
        Auth::user()->cart
            ->items()
            ->whereKey($id)
            ->update([
                'quantity' => $data['quantity'],
            ]);
    }
    public function count()
    {
        return Auth::user()->cart->items()->count();
    }
    public function deleteById($id)
    {
        $item = Auth::user()->cart
            ->items()
            ->findOrFail($id);

        return $item->delete();
    }
}
