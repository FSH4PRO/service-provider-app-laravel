<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\client\CategoryController as ClientCategoryController;

use App\Http\Controllers\client\AuthController as ClientAuthController;
use App\Http\Controllers\provider\AuthController as ProviderAuthController;
use App\Http\Controllers\client\ServiceController as ClientServiceController;
use App\Http\Controllers\Provider\ServiceController as ProviderServiceController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::prefix('client')->group(function () {
    Route::post('register', [ClientAuthController::class, 'register']);
    Route::post('login', [ClientAuthController::class, 'login']);
    Route::middleware('auth:api')->group(function () {
        Route::get('profile', [ClientAuthController::class, 'profile']);
    });
});

Route::prefix('provider')->group(function () {
    Route::post('register', [ProviderAuthController::class, 'register']);
    Route::post('login', [ProviderAuthController::class, 'login']);
    Route::middleware('auth:api')->group(function () {
        Route::get('profile', [ProviderAuthController::class, 'profile']);
    });
});

Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::resource('categories', AdminCategoryController::class);
});




// Provider Routes
Route::prefix('provider')->middleware('auth:api')->group(function () {
    Route::get('services', [ProviderServiceController::class, 'index']);
    Route::post('services', [ProviderServiceController::class, 'store']);
    Route::put('services/{id}', [ProviderServiceController::class, 'update']);
    Route::delete('services/{id}', [ProviderServiceController::class, 'destroy']);
});

// Admin Routes
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::get('services', [AdminServiceController::class, 'index']);
    Route::put('services/{id}/status', [AdminServiceController::class, 'updateStatus']);
    Route::delete('services/{id}', [AdminServiceController::class, 'destroy']);
});

// Client Routes
Route::prefix('client')->group(function () {
    Route::get('services', [ClientServiceController::class, 'index']);
    Route::get('services/{id}', [ClientServiceController::class, 'show']);
    Route::get('services/category/{id}', [ClientServiceController::class, 'byCategory']);
    Route::get('categories', [ClientCategoryController::class, 'index']);
});
