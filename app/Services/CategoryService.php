<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Facades\DB;

class CategoryService extends BaseService
{
    public function __construct(protected CategoryRepository $categoryRepository) {}
    public function add(array $data)
    {
        $this->categoryRepository->store($data);
    }
    public function findByID($id)
    {
        return Category::findOrFail($id);
    }
    public function updateCategory($id, $data, $file)
    {
        DB::transaction(function () use ($id, $data, $file) {

            $category = $this->findByID($id);

            $this->update($category, $data);

            if ($file) {
                FileService::update($file, $category->image);
            }
        });
    }
    public function update($category, array $data)
    {
        $category->update($data);
    }
    public function deleteById($id)
    {
        $rowsAffected = $this->categoryRepository->delete($id);
        if (! $rowsAffected) {
            abort(code: 404);
        }
    }
    public function forceDeleteById($id)
    {
        $category = $this->categoryRepository->findTrash($id);
        if ($category->image) {
            $this->categoryRepository->delete($category);
            FileService::deleteFromFolder('images_folder', $category->image);
        }
    }
    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }
    public function getEditeData($id)
    {
        return [
            'category' => $this->categoryRepository->find($id),
            'parents' => $this->categoryRepository->getPossibleParents($id)
        ];
    }
    public function findTrashesForDashboard()
    {
        return $this->categoryRepository->findTrashesForDashboard();
    }
    public function restoryByID($id)
    {
        return $this->categoryRepository->restore($id);
    }
}
