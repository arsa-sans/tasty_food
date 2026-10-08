<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Middleware\AdminAuth;

// ==============================
// PUBLIC ROUTES
// ==============================
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

// Menu Makanan & Pemesanan
Route::get('/menu', [OrderController::class, 'menu'])->name('menu');

// Keranjang Belanja
Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::match(['get', 'post'], '/keranjang/tambah/{menu}', [CartController::class, 'add'])->name('cart.add');
Route::post('/keranjang/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/keranjang/hapus/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/keranjang/kosongkan', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/keranjang/sync', [CartController::class, 'sync'])->name('cart.sync');

// Checkout & Pelacakan Pesanan
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
Route::get('/lacak-pesanan', [OrderController::class, 'trackSearch'])->name('order.search');
Route::get('/pesanan/{order_code}', [OrderController::class, 'track'])->name('order.track');
Route::post('/pesanan/{order_code}/konfirmasi-terima', [OrderController::class, 'confirmReceived'])->name('order.confirm-received');
Route::get('/riwayat-pesanan', [OrderController::class, 'history'])->name('order.history');

// Berita & Detail Kuliner
Route::get('/berita', [HomeController::class, 'berita'])->name('berita');
Route::get('/makanan/{slug}', [HomeController::class, 'makananDetail'])->name('makanan.detail');

Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');

Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');

Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

// ==============================
// PUBLIC USER AUTHENTICATION
// ==============================
Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->name('login.submit');
Route::get('/register', [UserAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [UserAuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

// ==============================
// ADMIN ROUTES
// ==============================
Route::prefix('admin')->group(function () {
    // Auth (tanpa middleware)
    Route::get('/', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Protected routes
    Route::middleware(AdminAuth::class)->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Menu Makanan CRUD
        Route::resource('menu', MenuController::class)->names('admin.menu');

        // Metode Pembayaran CRUD
        Route::resource('payment-methods', PaymentMethodController::class)->names('admin.payment-methods');

        // Pesanan Pelanggan (Orders Management & Tracking Lifecycle)
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
        Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update-status');
        Route::put('/orders/{order}/payment-status', [AdminOrderController::class, 'updatePaymentStatus'])->name('admin.orders.update-payment-status');
        Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');

        // Berita CRUD (uses slug)
        Route::get('/berita', [BeritaController::class, 'index'])->name('admin.berita.index');
        Route::get('/berita/create', [BeritaController::class, 'create'])->name('admin.berita.create');
        Route::post('/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
        Route::get('/berita/{berita:slug}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');
        Route::put('/berita/{berita:slug}', [BeritaController::class, 'update'])->name('admin.berita.update');
        Route::delete('/berita/{berita:slug}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');

        // Galeri CRUD
        Route::get('/galeri', [GaleriController::class, 'index'])->name('admin.galeri.index');
        Route::get('/galeri/create', [GaleriController::class, 'create'])->name('admin.galeri.create');
        Route::post('/galeri', [GaleriController::class, 'store'])->name('admin.galeri.store');
        Route::get('/galeri/{galeri}/edit', [GaleriController::class, 'edit'])->name('admin.galeri.edit');
        Route::put('/galeri/{galeri}', [GaleriController::class, 'update'])->name('admin.galeri.update');
        Route::delete('/galeri/{galeri}', [GaleriController::class, 'destroy'])->name('admin.galeri.destroy');

        // Messages CRUD
        Route::get('/messages', [MessageController::class, 'index'])->name('admin.messages.index');
        Route::get('/messages/{message}', [MessageController::class, 'show'])->name('admin.messages.show');
        Route::post('/messages/{message}/mark-as-read', [MessageController::class, 'markAsRead'])->name('admin.messages.mark-as-read');
        Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('admin.messages.destroy');
    });
});
