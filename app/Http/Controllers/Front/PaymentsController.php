<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function create(Order $order)
    {
        return view('front.payments.create', [
            'order' => $order,
        ]);
    }
    public function createStripePaymentIntent(Order $order)
    {
        $amount = (int) round(
            $order->orderItems->sum(function ($item) {
                return $item->price * $item->quantity;
            }) * 100
        );

        $paymentIntent = $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $amount,
            'currency' => 'usd',
            'automatic_payment_methods' => ['enabled' => true],
        ]);

         $payment = new Payment();

         $payment->forceFill([
                'order_id' => $order->id,
                'amount' => $paymentIntent->amount / 100,
                'currency' => $paymentIntent->currency,
                'status' => 'pending',
                'method' => 'stripe',
                'transaction_id' => $paymentIntent->id,
                'transaction_data' =>json_encode($paymentIntent),
            ])->save();

        return response()->json([
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    }
    public function confirm(Request $request, Order $order)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        $paymentIntent = $stripe->paymentIntents->retrieve(
            $request->query('payment_intent'),
            []
        );
        if ($paymentIntent->status == "succeeded") {
            $payment = Payment::where('order_id', $order->id)->first();

            $payment->forceFill([
                'status' => 'completed',
                'transaction_data' =>json_encode($paymentIntent),
            ])->save();

            // event('payment.succeeded', $payment);
            return redirect()->route('home')->with('success', 'Payment Done Successfully!');
        }

        return redirect()->route('order.payments.create',[
            'order' => $order,
            'status' => $paymentIntent->status,
        ]);
    }
}
