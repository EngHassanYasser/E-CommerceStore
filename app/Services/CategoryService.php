<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Str;

class CategoryService
{
    public function add($file, array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        if ($file) {
            $data['image'] = FileService::upload($file, 'categories');
        }
        Category::create($data);
    }
    public function findByID($id)
    {
        return Category::findOrFail($id);
    }
    public function updateCategory($id, $data, $file)
    {

        DB::transaction(function () use ($id, $data, $file) {

            $category = $this->findByID($id);
            if ($file) {
                $Image_path =  FileService::replaceImage($file, $category->image, 'categories');
                $data['image'] = $Image_path;
                $category->update($data);
            } else {
                $category->update($data);
            }
        });
    }
    public function deleteById($id)
    {
        $category = Category::findOrFail($id);
        $rowsAffected = $category->delete();

        if (! $rowsAffected) {
            abort(code: 404);
        }
    }
    public function forceDeleteById($id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        $category->onlyTrashed()->findOrFail($id);

        if ($category->image) {
            Category::delete($category);
            FileService::deleteFromFolder($category->image, 'categories');
        }
    }
    public function getAll()
    {
        return Category::with('parent', 'products')
            ->filter(Request::query())
            ->select('categories.*')->withCount('products')
            ->paginate(5);
    }
    public function getEditeData($id)
    {
        return [
            'category' => Category::find($id),
            'parents' =>  Category::where('id', '<>', $id)->get(),
        ];
    }
    public function findTrashesForDashboard()
    {
        return Category::onlyTrashed()->paginate();
    }
    public function restoryByID($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
    }
}
