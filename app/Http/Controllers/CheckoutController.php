<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Exceptions\InvalidOrderException;
use App\Http\Requests\checkout\storeCheckoutRequest;
use App\Services\CheckoutService;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;

class CheckoutController extends Controller
{
    public function __construct(
        protected CheckoutService $checkoutService,
        protected OrderService $orderService,
    ) {}
    public function create()
    {
        $cart = Auth::user()->cart;
        if ($cart->items->count() == 0) {
            throw new InvalidOrderException('Cart is empty');
        }
        return view('front.checkout', [
            'countries' => Countries::getNames(),
        ]);
    }
    public function store(storeCheckoutRequest $request)
    {
        $order = $this->orderService->store($request->validated());
        event(new OrderCreated($order));
        return redirect()->route('orders.payment.create', $order->id);
    }
}
