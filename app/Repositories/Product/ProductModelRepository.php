<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\Tag;
use App\Repositories\Base\BaseModelRepository;
use Arr;
use Illuminate\Support\Facades\DB;
use Str;

class ProductModelRepository extends BaseModelRepository implements ProductRepository
{
    public function construct() {
        parent::__construct();
    }
    protected function model()
    {
        return new Product();
    }
    // public function find($id)
    // {
    //     return Product::with('flags')->findOrFail($id);
    // }
    public function getProductsForApi(array $filters)
    {
        return Product::filter($filters)->with('category', 'store')->paginate(10);
    }
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $product = Product::create($data);
            $flags = $data['flags'] ?? [];

            $product->flags()->sync($flags);
            return $product->fresh();
        });
    }

    public function update($product, array $data)
    {
        return DB::transaction(function () use ($product, $data) {
            $product->update($data);
            $flags = $data['flags'] ?? [];

            $product->flags()->sync($flags);

            return $product->fresh();
        });
    }
    // public function getProductsForDashboard()
    // {
    //     return $this->getPaginatedWithRelations(['category', 'store']);
    // }

    public function getActiveProducts()
    {
        return Product::with('category')->active()
            ->latest()
            ->limit(8)
            ->get();
    }

    public function resolveTags(string $tags): array
    {
        $tagIds = [];

        $tags = array_filter(explode(',', $tags));

        foreach ($tags as $name) {
            $slug = Str::slug($name);

            $tag = Tag::firstOrCreate(
                ['slug' => $slug],
                ['name' => $name]
            );

            $tagIds[] = $tag->id;
        }

        return $tagIds;
    }

    public function updateWithTags(int $id, array $data): Product
    {
        return DB::transaction(function () use ($id, $data) {
            $product = $this->find($id);
            $this->update(
                $product,
                Arr::except($data, 'tags')
            );
            $tagIds = $this->resolveTags($data['tags'] ?? '');

            $product->tags()->sync($tagIds);

            return $product->fresh();
        });
    }
}
