<?php

namespace App\Repositories\Payment;

use App\Repositories\Base\BaseRepository;

interface PaymentRepository extends BaseRepository{
    public function create($order_id,$paymentIntent);
    public function confirm($order_id,$paymentIntent);
}