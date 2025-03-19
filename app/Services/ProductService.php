<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Interfaces\IProductRepository;

class ProductService
{
    protected IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getList()
    {
        $columns = ['*'];
        $page = request()->input('page', 1);
        $limit = request()->input('limit', 6);
        $search = request()->input('search', '');

        return $this->productRepository->getProducts($limit, $page, $search);
    }

    public function getProductById(int $id)
    {
        return $this->productRepository->find($id);
    }

    public function createProduct(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function updateProduct(Product $product, array $data)
    {
        return $this->productRepository->update($product, $data);
    }

    public function deleteProduct(Product $product)
    {
        return $this->productRepository->delete($product);
    }
}
