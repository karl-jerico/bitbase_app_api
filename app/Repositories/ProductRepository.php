<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\IProductRepository;

class ProductRepository implements IProductRepository
{
    protected Product $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function getProducts($limit, $page, $search)
    {
        return $this->model
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->orWhere('name', 'LIKE', '%' . $search . '%');
                }
            })
            ->limit($limit)
            ->latest()
            ->paginate($limit, ['*'], 'page', $page);
    }

    public function find(int $id)
    {
        return Product::findOrFail($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data)
    {
        $product->update($data);
        return $product;
    }

    public function delete(Product $product)
    {
        $product->delete();
    }
}
