<?php

use App\Models\category;

class CategoryModelRepository implements CategoryRepository {
    public function all() {
        return category::all();
    }
}