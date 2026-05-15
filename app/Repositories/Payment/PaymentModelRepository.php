<?php
namespace App\Repositories\Payment;
use App\Models\Payment;
use App\Repositories\Base\BaseModelRepository;

class PaymentModelRepository extends BaseModelRepository implements PaymentRepository {
    public function __construct()
    {
       parent::__construct();
    }
    protected function model()
    {
        return new Payment();
    }
    public function create($order_id,$paymentIntent) {
        Payment::create([
                'order_id' => $order_id,
                'amount' => $paymentIntent->amount / 100,
                'currency' => $paymentIntent->currency,
                'status' => 'pending',
                'method' => 'stripe',
                'transaction_id' => $paymentIntent->id,
                'transaction_data' =>json_encode($paymentIntent),
            ]);
    }
    public function confirm($order_id,$paymentIntent) {
        $payment = Payment::where('order_id', $order_id)->first();
        $payment->update([
            'status' => 'completed',
            'transaction_data' =>json_encode($paymentIntent),
        ]);
    }
}