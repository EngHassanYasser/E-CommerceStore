<?php

namespace App\Repositories\Product;

use App\Models\Product;

interface ProductRepository
{
    public function find($id);
    public function getProductsForApi(array $filters);
    public function store(array $data);
    public function update(Product $product, array $data);
    public function updateWithTags(int $id, array $data): Product;
    public function getActiveProducts();
}