<?php

namespace App\Services;

use App\Repositories\Checkout\CheckoutRepository;

class CheckoutService
{
    public function __construct(protected CheckoutRepository $checkoutRepository) {}
    public function store($data, $cart)
    {
        return $this->checkoutRepository->store($data, $cart);
    }
}
