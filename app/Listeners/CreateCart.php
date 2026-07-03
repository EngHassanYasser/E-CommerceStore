<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CreateCart
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        $cart = $event->user->cart()->create();

        Log::channel('debug')->info('Cart created', [
            'user_id' => $event->user->id,
            'cart_id' => $cart->id,
        ]);
    }
}
