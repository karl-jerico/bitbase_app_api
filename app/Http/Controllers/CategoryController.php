<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Flugg\Responder\Http\Responses\SuccessResponseBuilder;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): SuccessResponseBuilder
    {
        $categories = $this->categoryService->getList();
        return responder()->success($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): SuccessResponseBuilder
    {
        $category = $this->categoryService->createCategory($request->validated());
        return responder()->success($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): SuccessResponseBuilder
    {
        $category = $this->categoryService->getCategoryById($id);
        return responder()->success($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category): SuccessResponseBuilder
    {
        $category = $this->categoryService->updateCategory($category, $request->validated());
        return responder()->success($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): SuccessResponseBuilder
    {
        $this->categoryService->deleteCategory($category);
        return responder()->success(['message' => 'Category deleted successfully']);
    }
}

