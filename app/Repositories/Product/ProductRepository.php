<?php

namespace App\Repositories\Product;

use App\Repositories\Base\BaseRepository;

interface ProductRepository extends BaseRepository
{
    public function find($id);
    public function getProductsForApi(array $filters);
    public function store(array $data);
    public function update($product, array $data);
    public function updateWithTags(int $id, array $data);
    public function getActiveProducts();
}