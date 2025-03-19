<?php

namespace App\Repositories\Interfaces;

use App\Models\Product;

interface IProductRepository
{
    public function getProducts($limit, $page, $search);
    public function find(int $id);
    public function create(array $data);
    public function update(Product $product, array $data);
    public function delete(Product $product);
}
