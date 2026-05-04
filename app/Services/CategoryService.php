<?php
class CategoryService {
    public function __construct(protected CategoryRepository $categoryRepository) {}

    public function all()
    {
        return $this->categoryRepository->all();
    }
}