<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Flugg\Responder\Http\Responses\SuccessResponseBuilder;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(): SuccessResponseBuilder
    {
        $products = $this->productService->getList();
        return responder()->success($products);
    }

    public function store(ProductRequest $request): SuccessResponseBuilder
    {
        $product = $this->productService->createProduct($request->validated());
        return responder()->success($product);
    }

    public function update(ProductRequest $request, Product $product): SuccessResponseBuilder
    {
        $updatedProduct = $this->productService->updateProduct($product, $request->validated());
        return responder()->success($updatedProduct);
    }

    public function destroy(Product $product): SuccessResponseBuilder
    {
        $this->productService->deleteProduct($product);
        return responder()->success(['message' => 'Product deleted successfully']);
    }
}
