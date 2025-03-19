<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\ICategoryRepository;

class CategoryRepository implements ICategoryRepository
{
    protected Category $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getCategoriesWithProducts($limit, $page, $search)
    {
        return $this->model
            // ->with(['products' => function ($query) {
            //     $query->oldest();
            // }])
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->orWhere('name', 'LIKE', '%' . $search . '%');
                }
            })
            ->limit($limit)
            ->latest()
            ->paginate($limit, ['*'], 'page', $page);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($model, array $data)
    {
        $model->update($data);
        return $model;
    }

    public function delete($model)
    {
        return $model->delete();
    }
}
