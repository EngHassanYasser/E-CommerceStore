<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    public function __construct(protected CategoryRepository $categoryRepository) {}
    public function store(array $data)
    {
        $this->categoryRepository->store($data);
    }
    public function findByID($id)
    {
        return Category::findOrFail($id);
    }
    public function update($category, array $data)
    {
        $category->update($data);
    }
    public function destroy($id)
    {
        $rowsAffected = $this->categoryRepository->destroy($id);
        if (! $rowsAffected) {
            abort(code: 404);
        }
    }
    public function forceDelete($id)
    {
        $category = $this->categoryRepository->findTrash($id);
        if ($category->image) {
            $this->categoryRepository->foreDelete($category);
            Storage::disk('public')->delete('images_folder/' . $category->image);
        }
    }
    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }
    public function getEditeData($id)
    {
        return [
            'category' => $this->categoryRepository->findByID($id),
            'parents' => $this->categoryRepository->getPossibleParents($id)
        ];
    }
    public function findTrashesForDashboard()
    {
        return $this->categoryRepository->findTrashesForDashboard();
    }
    public function restore($id) {
        return $this->categoryRepository->restore($id);
    }
}
