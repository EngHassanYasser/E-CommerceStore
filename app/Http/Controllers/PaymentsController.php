<?php

namespace App\Http\Controllers;

use App\Facades\Stripe;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentsController extends Controller
{
    public function __construct() {}
    public function create(Order $order)
    {

        return view('front.payments.create', compact('order'));
    }
    public function createStripePaymentIntent(Order $order)
    {
        try {
            $paymentIntent = Stripe::createIntent($order);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (\Throwable $e) {
            Log::channel('debug')->debug('test', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return response()->json([
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ], 500);
        }
    }
    public function confirm(Request $request, Order $order)
    {
        $paymentIntent = Stripe::confirmPayment($order, $request->query('payment_intent'));

        if ($paymentIntent->status == "succeeded") {
            return redirect()->route('home')
                ->with('success', 'Payment Done Successfully!');
        }

        return redirect()->route('checkout', [
            'order' => $order,
            'status' => $paymentIntent->status,
        ]);
    }
}
