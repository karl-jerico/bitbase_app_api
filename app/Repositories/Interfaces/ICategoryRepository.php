<?php

namespace App\Repositories\Interfaces;

use App\Models\Category;

interface ICategoryRepository
{
    public function getCategoriesWithProducts(int $limit, int $page, string $search);
    public function find(int $id);
    public function create(array $data);
    public function update(Category $category, array $data);
    public function delete(Category $category);
}
