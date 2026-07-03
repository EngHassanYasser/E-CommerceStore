<?php

namespace App\Listeners;

use App\Events\CartCleared;

class ClearUserCart
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(CartCleared $event)
    {
        $event->user->cart->items()->delete();
    }
}
