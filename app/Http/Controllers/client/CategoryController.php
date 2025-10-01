<?php

namespace App\Http\Controllers\client;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        return Category::all();
    }
}
