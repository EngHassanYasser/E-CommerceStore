<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\Base\BaseRepository;

interface ProductRepository extends BaseRepository
{
    public function find($id);
    public function getProductsForApi(array $filters);
    public function store(array $data);
    public function update($product, array $data);
    public function updateWithTags(Product $product, array $data);
    public function getActiveProducts();
}