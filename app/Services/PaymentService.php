<?php

namespace App\Services;

use App\Repositories\Payment\PaymentRepository;

class PaymentService extends BaseService
{
    public function __construct(
        protected PaymentRepository $paymentRepository
    ) {}
    public function create($order_id, $paymentIntent)
    {
        return $this->paymentRepository->create($order_id, $paymentIntent);
    }
    public function confirm($order_id, $paymentIntent)
    {
        return $this->paymentRepository->confirm($order_id, $paymentIntent);
    }
}
