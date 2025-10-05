<?php





use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;

Route::get('/', function () {
    return view('auth.login');
});



//  admin
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

    // Orders
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');

    //users
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');


    // Dashboard + protected routes
    Route::middleware('auth')->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        //users
        Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
        Route::delete('users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');


        // Categories
        Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::post('categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::put('categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('categories/{id}', [CategoryController::class, 'distroy'])->name('admin.categories.destroy');

        // Services
        Route::put('services/{id}/status', [AdminServiceController::class, 'updateStatus'])->name('admin.services.updateStatus');
        Route::delete('services/{id}', [AdminServiceController::class, 'destroy'])->name('admin.services.destroy');

        //Orders
        Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');
    });
});
