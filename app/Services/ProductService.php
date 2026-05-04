<?php
namespace App\Services;
use App\Repositories\Product\ProductRepository;
use Arr;
use CategoryService;
use Illuminate\Support\Facades\Auth;
use TagService;

class ProductService
{
    public function __construct(
        protected ProductRepository $productRepository,
        protected CategoryService $categoryRepository,
        protected TagService $tagService,
    ) {}
    public function storeFromDashboard(array $data)
    {
        $data['store_id'] = Auth::user()->store_id;
        return $this->productRepository->store($data);
    }
    public function getEditData($id) {
        $product = $this->productRepository->find($id);
        return [
        'product' => $product,
        'categories' => $this->categoryRepository->all(),
        'tags' => $product->tags->pluck('name')->implode(','),
      ];
    }

    public function update($id, array $data)
    {
        $product = $this->productRepository->find($id);

        $product = $this->productRepository->update(
            $product,
            Arr::except($data, 'tags')
        );

        // 2. resolve tags
        $tagIds = $this->tagService->resolveTags($data['tags'] ?? '');

        // 3. sync relation
        $product->tags()->sync($tagIds);

        return $product;
    }
}
