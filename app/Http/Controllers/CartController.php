<?php

namespace App\Http\Controllers;

use App\Http\Requests\Web\StoreCartRequest;
use App\Http\Requests\Web\UpdateCartRequest;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(protected CartService $cartService) {}

    public function index()
    {
        $total = $this->cartService->total();
        $cart = Auth::user()
            ->cart()->with('items.product')->first();
   dd($cart->toArray(),$cart->items->count());
        return view('front.cart', compact('cart', 'total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        Log::channel('debugging')->error('testing', $request->validated());
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
