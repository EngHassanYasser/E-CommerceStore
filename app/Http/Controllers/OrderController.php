<?php

namespace App\Http\Controllers;

use App\Http\Requests\Web\StoreOrderRequest;
use App\Services\OrderService;

class OrderController
{
    public function __construct(protected OrderService $orderService) {}
    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->store($request->validated());
        if (! $order) {
            redirect()->route('home')->with([
                'success' => 'Order Created Successfully'
            ]);
        }
    }
}
