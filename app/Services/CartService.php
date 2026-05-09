<?php
namespace App\Services;
use App\Repositories\Cart\CartRepository;

class CartService
{
    public function __construct(protected CartRepository $cartepository) {}
    public function store($data)
    {
        return $this->cartepository->add($data['product_id'], $data['quantity']);
    }
    public function total() {
       return $this->cartepository->total();
    }
    public function update($id, $data)
    {
        return $this->cartepository->update($id, $data['quantity']);
    }
    public function destroy($id)
    {
        return  $this->cartepository->delete($id);
    }
    public function count() {
        return $this->cartepository->count();
    }
}
