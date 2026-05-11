<?php

namespace App\Repositories\Category;

use App\Repositories\Base\BaseRepository;

interface CategoryRepository extends BaseRepository
{
    public function getAll();
    public function findTrashesForDashboard();
    public function getPossibleParents($id);
}
