<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->get();
        $services = Service::with(['provider','category'])->get();

        return view('admin.dashboard', compact('categories', 'services'));
    }
}