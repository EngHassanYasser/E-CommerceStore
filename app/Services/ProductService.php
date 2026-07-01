<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Flag;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Arr;
use Illuminate\Support\Facades\Request;
use Str;

class ProductService
{
    public function storeFromDashboard(array $data)
    {
        return DB::transaction(function () use ($data) {
            $product = Product::create($data);
            $flags = $data['flags'] ?? [];

            $product->flags()->sync($flags);
            return $product->fresh();
        });
    }
    public function getEditData($id)
    {
        $product = Product::with('flags')->findOrFail($id);
        return [
            'productFlags' => $product->flags()->pluck('id')->toArray(),
            'product' => $product,
            'categories' => $this->getAll(),
            'tags' => $product->tags->pluck('name')->implode(','),
            'flags' => Flag::all(),
        ];
    }
    public function getProductsForApi(array $filters)
    {
        return Product::filter($filters)->with('category', 'store')->paginate(10);
    }
    public function store($data)
    {
        return DB::transaction(function () use ($data) {
            $product = Product::create($data);
            $flags = $data['flags'] ?? [];

            $product->flags()->sync($flags);
            return $product->fresh();
        });
    }
    public function update($product, $data)
    {
        return DB::transaction(function () use ($product, $data) {
            $product->update($data);
            $flags = $data['flags'] ?? [];

            $product->flags()->sync($flags);

            return $product->fresh();
        });
    }
    public function deleteByID($id)
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }
    public function getActiveProducts()
    {
        return Product::with('category')->active()
            ->latest()
            ->limit(8)
            ->get();
    }
    public function getProductsForDashboard()
    {
        return Product::with(['category', 'store'])->paginate(10);
    }
    public function find($id)
    {
        return Product::with('flags')->findOrFail($id);
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
    public function updateWithTags($id, $data, $file)
    {
        $product = $this->find($id);
        if ($file) {
            $data['image'] = FileService::replaceImage($file, $product->image, 'products');
        }
        return DB::transaction(function () use ($product, $data) {
            $product->update(Arr::except($data, 'tags'));
            $tagIds = $this->resolveTags($data['tags'] ?? '');

            $product->tags()->sync($tagIds);

            return $product->fresh();
        });
    }
    public function getAll()
    {
        return Category::with('parent', 'products')
            ->filter(Request::query())
            ->select('categories.*')->withCount('products')
            ->paginate(5);
    }
}
