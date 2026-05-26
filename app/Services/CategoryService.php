<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Facades\DB;
use Str;

class CategoryService extends BaseService
{
    public function __construct(protected CategoryRepository $categoryRepository) {}
    public function add($file,array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        if ($file) {
            $data['image'] = FileService::upload($file,'categories');
        }
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
            if ($file) {
                $Image_path =  FileService::replaceImage($file, $category->image,'categories');
                $data['image'] = $Image_path;
                $category->update($data);
            } else {
                $category->update($data);
            }
        });
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
            FileService::deleteFromFolder($category->image,'categories');
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
