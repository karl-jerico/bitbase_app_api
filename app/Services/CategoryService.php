<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\Interfaces\ICategoryRepository;

class CategoryService
{
    protected ICategoryRepository $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getList()
    {
        $page = request()->input('page', 1);
        $limit = request()->input('limit', 6);
        $search = request()->input('search', '');

        return $this->categoryRepository->getCategoriesWithProducts($limit, $page, $search);
    }

    public function getCategoryById(int $id)
    {
        return $this->categoryRepository->find($id);
    }

    public function createCategory(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function updateCategory(Category $category, array $data)
    {
        return $this->categoryRepository->update($category, $data);
    }

    public function deleteCategory(Category $category)
    {
        return $this->categoryRepository->delete($category);
    }
}
