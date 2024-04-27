<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\ProductService;

class ProductController extends Controller
{
    private $productService;
    private $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index(): \Illuminate\View\View
    {
        $pagination = $this->productService->list();
        return view('index', compact('pagination'));
    }

    public function detail(int $id): \Illuminate\View\View
    {
        $detail_data = $this->productService->detail($id);
        $result = $detail_data;
        return view('detail', compact('result'));
    }

    public function category(int $id): \Illuminate\View\View
    {
        $category = $this->categoryService->categoryData($id);
        $paginate = $this->productService->categoryList($id);
        return view('category', compact('paginate', 'category'));
    }
}
