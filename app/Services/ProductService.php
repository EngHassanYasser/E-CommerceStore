<?php

namespace App\Services;

use App\Models\Flag;
use App\Models\Product;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Facades\Auth;

class ProductService extends BaseService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected CategoryRepository $categoryRepository,
        Product $product
    ) {
        parent::__construct($product);
    }
    public function storeFromDashboard(array $data)
    {
        return $this->productRepository->store($data);
    }
    public function getEditData($id)
    {
        $product = $this->productRepository->find($id);
        return [
            'productFlags' => $product->flags()->pluck('id')->toArray(),
            'product' => $product,
            'categories' => $this->categoryRepository->getAll(),
            'tags' => $product->tags->pluck('name')->implode(','),
            'flags' => Flag::all(),
        ];
    }
    public function getProductsForApi(array $filters)
    {
        return $this->productRepository->getProductsForApi($filters);
    }
    public function store($data)
    {
        return $this->productRepository->store($data);
    }
    public function update($product, $data)
    {
        return $this->productRepository->update($product, $data);
    }
    public function deleteByID($id)
    {
        return $this->productRepository->deleteByID($id);
    }
    public function getActiveProducts()
    {
        return $this->productRepository->getActiveProducts();
    }
    public function getProductsForDashboard()
    {
        return $this->productRepository->GetPaginatedWithRelations(['category', 'store']);
    }
    public function find($id)
    {
        return $this->productRepository->find($id);
    }
    public function updateWithTags($id, $data, $file)
    {
        $product = $this->find($id);
        if ($file) {
            $data['image'] = FileService::replaceImage($file, $product->image, 'products');
        }
        return $this->productRepository->updateWithTags($product, $data);
    }
}
