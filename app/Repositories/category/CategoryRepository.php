<?php

namespace App\Repositories\Category;

interface CategoryRepository
{
    public function findByID($id);
    public function getAll();
    public function update($category, $data);
    public function destroy($id);
    public function restore($id);
    public function findTrashesForDashboard();
    public function findTrash($id);
    public function foreDelete($category);
    public function getPossibleParents($id);
    public function store($data);
}
