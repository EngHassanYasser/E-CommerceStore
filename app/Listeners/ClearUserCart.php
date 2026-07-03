<?php

namespace App\Listeners;

use App\Events\CartCleared;
use App\Services\CartService;

class ClearUserCart
{
    /**
     * Create the event listener.
     */
    public function __construct(protected CartService $cartService)
    {
        //
    }

    /**
     * Handle the event.
     */
     public function handle()
    {
    //    $this->cartService->empty();
    }
}
