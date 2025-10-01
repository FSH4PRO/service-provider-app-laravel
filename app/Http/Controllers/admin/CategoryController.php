<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Services\Admin\CategoryService;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;



class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->index();
        $services = Service::with(['provider','category'])->get();
        return view('admin.categories.index', compact('categories','services'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->categoryService->store($request->validated());
        return redirect()->back()->with('success', 'Category created successfully');
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $this->categoryService->update($id, $request->validated());
        return redirect()->back()->with('success', 'Category updated successfully');
    }

    public function distroy($id)
    {
        $this->categoryService->delete($id);
        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
