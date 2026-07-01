<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreCartRequest;
use App\Http\Requests\Web\UpdateCartRequest;
use App\Models\Cart;
use App\Services\CartService;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(protected CartService $cartService ) {}

    public function index(Cart $cart)
    {
        $total = $this->cartService->total();
        return view('front.cart', compact('cart', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        $this->cartService->store($request->validated());

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'item added to cart',
            ], 201);
        }

        return redirect()->route('cart.index')->with('success', 'product added to cart');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, $id)
    {
        $data = $request->validated();
        $this->cartService->update($id, $data['quantity']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $this->cartService->deleteById($id);

        return [
            'message' => 'item deleted successfully',
        ];
    }
}
