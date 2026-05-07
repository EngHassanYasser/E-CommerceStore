<?php
namespace App\Services;

use App\Models\Flag;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Product\ProductRepository;
use Arr;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected CategoryRepository $categoryRepository,
    ) {}
    public function storeFromDashboard(array $data)
    {
        $data['store_id'] = Auth::user()->store_id;
        return $this->productRepository->store($data);
    }
    public function getEditData($id) {
        $product = $this->productRepository->find($id);
        return [
        'productFlags'=> $product->flags()->pluck('id')->toArray(),
        'product' => $product,
        'categories' => $this->categoryRepository->getAll(),
        'tags' => $product->tags->pluck('name')->implode(','),
        'flags'=>Flag::all(),
      ];
    }
}
