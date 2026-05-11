<?php

namespace App\Repositories\Category;

use App\Models\category;
use App\Repositories\Base\BaseModelRepository;
use Illuminate\Support\Facades\Request;

class CategoryModelRepository extends BaseModelRepository implements CategoryRepository 
{
    public function __construct(Category $category) {
        parent::__construct($category);
    }
    public function getAll()
    {
        return Category::with('parent', 'products')
            ->filter(Request::query())
            ->select('categories.*')->withCount('products')
            ->paginate(5);
    }
    public function findTrashesForDashboard()
    {
        return Category::onlyTrashed()->paginate();
    }
    public function getPossibleParents($id)
    {
        return Category::where('id', '<>', $id)->get();
    }
}