<?php

namespace App\Repositories\Category;

interface CategoryRepository
{
    public function getAll();
    public function findTrashesForDashboard();
    public function getPossibleParents($id);
}
