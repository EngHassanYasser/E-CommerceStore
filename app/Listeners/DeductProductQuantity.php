<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Events\OrderCreated;
class DeductProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;
        foreach($order->products as $product) {
            $product->decrement('quantity',$product->pivot->quantity);

            // Product::where('id','=',$product->product_id)
            //     ->update([
            //             'quantity'=> DB::raw("quantity - {$product->quantity}")
            //         ]);
        }
    }
}
