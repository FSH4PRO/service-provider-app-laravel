<?php

namespace App\Http\Controllers\provider;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::get();
        return $this->success(CategoryResource::collection($categories), 'Categories retrieved successfully',200);
    }
}
