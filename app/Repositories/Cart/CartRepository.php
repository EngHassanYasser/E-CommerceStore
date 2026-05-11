<?php

namespace App\Repositories\Cart;

use App\Models\Cart;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Collection;

interface CartRepository extends BaseRepository
{
    public function all(): Collection;
    public function getCartItems(Cart $cart);
    public function store($id
    , $quantity = 1);

    public function update($id, $quantity);

    public function empty($id);

    public function total(): float;
    public function count();
}
