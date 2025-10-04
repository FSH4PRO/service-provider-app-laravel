<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\FavoritesController;
use App\Http\Controllers\client\AuthController as ClientAuthController;
use App\Http\Controllers\client\OrderController as ClientOrderController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\provider\AuthController as ProviderAuthController;
use App\Http\Controllers\admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\client\ServiceController as ClientServiceController;
use App\Http\Controllers\provider\OrderController as ProviderOrderController;
use App\Http\Controllers\client\CategoryController as ClientCategoryController;
use App\Http\Controllers\Provider\ServiceController as ProviderServiceController;
use App\Http\Controllers\provider\CategoryController as ProviderCategoryController;

// Provider Routes
Route::prefix('provider')->group(function () {
    Route::post('register', [ProviderAuthController::class, 'register']);
    Route::post('login', [ProviderAuthController::class, 'login']);
    Route::middleware('auth:api')->group(function () {
        Route::get('profile', [ProviderAuthController::class, 'profile']);
    });});
    
Route::prefix('provider')->middleware('auth:api')->group(function () {
    Route::get('services', [ProviderServiceController::class, 'index']);
    Route::post('services', [ProviderServiceController::class, 'store']);
    Route::put('services/{id}', [ProviderServiceController::class, 'update']);
    Route::delete('services/{id}', [ProviderServiceController::class, 'destroy']);
    Route::get('categories', [ProviderCategoryController::class, 'index']);
    Route::get('getOrders', [ProviderOrderController::class, 'index']);
    Route::get('getOrder/{id}', [ProviderOrderController::class, 'show']);
});

// Admin Routes
Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::get('services', [AdminServiceController::class, 'index']);
    Route::put('services/{id}/status', [AdminServiceController::class, 'updateStatus']);
    Route::delete('services/{id}', [AdminServiceController::class, 'destroy']);
    Route::resource('categories', AdminCategoryController::class);

});

// Client Routes

Route::prefix('client')->group(function () {
    Route::post('register', [ClientAuthController::class, 'register']);
    Route::post('login', [ClientAuthController::class, 'login']);
    Route::middleware('auth:api')->group(function () {
        Route::get('profile', [ClientAuthController::class, 'profile']);
    });});
Route::prefix('client')->middleware('auth:api')->group(function () {
   
    Route::get('services', [ClientServiceController::class, 'index']);
    Route::get('services/{id}', [ClientServiceController::class, 'show']);
    Route::get('services/category/{id}', [ClientServiceController::class, 'byCategory']);
    Route::get('categories', [ClientCategoryController::class, 'index']);
    Route::post('makeOrder', [ClientOrderController::class, 'makeOrder']);
    Route::get('getOrders', [ClientOrderController::class, 'index']);
    Route::get('getOrder/{id}', [ClientOrderController::class, 'show']);
    Route::delete('cancelOrder/{id}', [ClientOrderController::class, 'cancel']);
    Route::post('favorite/{id}', [FavoritesController::class, 'store']);
    Route::get('getFavorites', [FavoritesController::class, 'index']);
    Route::delete('removeFavorite/{id}', [FavoritesController::class, 'destroy']);
});


