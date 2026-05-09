<?php

namespace App\Repositories\Category;

use App\Models\category;
use Illuminate\Support\Facades\Request;

class CategoryModelRepository implements CategoryRepository
{
    public function getAll()
    {
        return Category::with('parent', 'products')
            ->filter(Request::query())
            ->select('categories.*')->withCount('products')
            ->paginate(5);
    }
    public function findByID($id)
    {
        return category::findOrFail($id);
    }
    public function store($data) {
        return  Category::create($data);

    }
    public function update($category, $data)
    {
        $category->update($data);
    }
    public function destroy($id)
    {
        return category::destroy($id);
    }
    public function restore($id)
    {
        return Category::onlyTrashed()->findOrFail($id)->restore();
    }
    public function findTrashesForDashboard()
    {
        return Category::onlyTrashed()->paginate();
    }
    public function findTrash($id)
    {
        return Category::onlyTrashed()->findOrFail($id);
    }
    public function foreDelete($category)
    {
        $category->forceDelete();
    }
    public function getPossibleParents($id)
    {
        return Category::where('id', '<>', $id)->get();
    }
}
