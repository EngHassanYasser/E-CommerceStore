<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{
    protected $items;

    public function __construct()
    {
        $this->items = collect([]);
    }
    public function getCartItems()
    {
        return Cart::all();
    }
    public function store($data)
    {
        $product = Product::findOrFail($data['product_id'], $quantity = 1);

        $item = Cart::where('product_id', $product->id)->first();

        if (! $item) {
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);

            $this->items->push($cart);

            return;
        }
        return $item->increment('quantity', $quantity);
    }
    public function total()
    {
        // return (float) Cart::join('products','products.id','=','carts.product_id')
        //     ->selectRaw('SUM(products.price * carts.quantity) as total')
        //     ->value('total') ?? 0;

        return (float) $this->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }
    public function update($id, $data)
    {
        Cart::where('id', $id)
            ->update([
                'quantity' => $data['quantity'],
            ]);
    }
    public function count()
    {
        if (!Auth::check()) {
            return 0;
        }
        return Cart::where('user_id', Auth::user()->id)->count() ?? 0;
    }
    public function deleteById($id)
    {
        $model = Cart::findOrFail($id);
        return $model->delete();
    }
}
