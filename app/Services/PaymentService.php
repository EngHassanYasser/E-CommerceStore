<?php

namespace App\Services;

use App\Models\Payment;

class PaymentService
{
    public function create($order_id, $paymentIntent)
    {
        Payment::create([
            'order_id' => $order_id,
            'amount' => $paymentIntent->amount / 100,
            'currency' => $paymentIntent->currency,
            'status' => 'pending',
            'method' => 'stripe',
            'transaction_id' => $paymentIntent->id,
            'transaction_data' => json_encode($paymentIntent),
        ]);
    }
    public function confirm($order_id, $paymentIntent)
    {
        $payment = Payment::where('order_id', $order_id)->first();
        $payment->update([
            'status' => 'completed',
            'transaction_data' => json_encode($paymentIntent),
        ]);
    }
}
