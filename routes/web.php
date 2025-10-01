<?php

// use App\Http\Controllers\Admin\AuthController;
// use Illuminate\Support\Facades\Route;

// Route::get("login", [AuthController::class, "loginView"])->name("login");
// Route::post("login", [AuthController::class, "login"])->name("login_action");
// Route::get('dashboard', [AuthController::class, "dashboard"])->name('dashboard');

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::prefix('admin')->middleware('auth')->group(function () {
//     Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

//     Route::post('categories', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');
//     Route::put('categories/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update');
//     Route::delete('categories/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('categories.destroy');

//     Route::put('services/{id}/status', [\App\Http\Controllers\Admin\ServiceController::class, 'updateStatus'])->name('admin.services.updateStatus');
//     Route::delete('services/{id}', [\App\Http\Controllers\Admin\ServiceController::class, 'destroy'])->name('admin.services.destroy');
// });

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;


// 🔹 Routes الأدمن
Route::prefix('admin')->group(function () {
    // Login
    Route::get('login', [AdminAuthController::class, 'loginView'])->name('admin.login.view');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Categories
    Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');

    // Dashboard + protected routes
    Route::middleware('auth')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        
        // Categories
        Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::post('categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::put('categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('categories/{id}', [CategoryController::class, 'distroy'])->name('admin.categories.destroy');

        // Services
        Route::put('services/{id}/status', [AdminServiceController::class, 'updateStatus'])->name('admin.services.updateStatus');
        Route::delete('services/{id}', [AdminServiceController::class, 'destroy'])->name('admin.services.destroy');
    });
});