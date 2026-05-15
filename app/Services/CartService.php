<?php
namespace App\Services;

use App\Repositories\Cart\CartRepository;
class CartService extends BaseService
{
    public function __construct(protected CartRepository $cartepository) {
        parent::__construct();
    }
    public function store($data)
    {
        return $this->store($data['product_id'], $data['quantity']);
    }
    public function total() {
       return $this->cartepository->total();
    }
    public function update($id, $data)
    {
        return $this->cartepository->update($id, $data['quantity']);
    }
    public function count() {
        return $this->cartepository->count();
    }
    public function delete($id) {
        return $this->cartepository->deleteByID($id);
    }
}
