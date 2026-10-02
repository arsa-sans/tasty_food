<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Middleware\AdminAuth;

// ==============================
// PUBLIC ROUTES
// ==============================
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

Route::get('/berita', [HomeController::class, 'berita'])->name('berita');

Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

// ==============================
// ADMIN ROUTES
// ==============================
Route::prefix('admin')->group(function () {
    // Auth (tanpa middleware)
    Route::get('/', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Protected routes
    Route::middleware(AdminAuth::class)->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Food CRUD
        Route::resource('foods', FoodController::class)->names([
            'index' => 'admin.foods.index',
            'create' => 'admin.foods.create',
            'store' => 'admin.foods.store',
            'edit' => 'admin.foods.edit',
            'update' => 'admin.foods.update',
            'destroy' => 'admin.foods.destroy',
        ]);

        // Reviews (read-only + delete, NO edit/update)
        Route::get('/reviews', [ReviewController::class, 'index'])->name('admin.reviews.index');
        Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('admin.reviews.show');
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('admin.reviews.destroy');
    });
});
