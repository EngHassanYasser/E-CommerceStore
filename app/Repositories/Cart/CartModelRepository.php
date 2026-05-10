<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Models\Product;
use App\Repositories\BaseModelRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CartModelRepository extends BaseModelRepository implements CartRepository
{
    protected $items;

    public function __construct(Cart $cart)
    {
        parent::__construct($cart);

        $this->items = collect([]);
    }

    public function all(): Collection
    {
        if (! $this->items->count()) {
            $this->items = Cart::with('product')->get();
        }

        return $this->items;
    }

    public function store($id, $quantity = 1)
    {
        $product = Product::findOrFail($id);

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


    public function update($id, $quantity)
    {
        Cart::where('id', $id)
            ->update([
                'quantity' => $quantity,
            ]);
    }

    public function empty($id)
    {
    Cart::where('user_id', $id)->delete();
    }

    public function total(): float
    {
        // return (float) Cart::join('products','products.id','=','carts.product_id')
        //     ->selectRaw('SUM(products.price * carts.quantity) as total')
        //     ->value('total') ?? 0;

        return (float) $this->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }
    public function count()
    {
        if (!Auth::check()) {
            return 0;
        }
        return Cart::where('user_id', Auth::user()->id)->count() ?? 0;
    }
    public function getCartItems(Cart $cart) {
       return $cart->get()->all();
    }
}
