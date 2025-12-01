<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    // Trỏ vào file index nằm trong thư mục pages/home
    return view('pages.home.index'); 
});

// Route hiển thị chi tiết sản phẩm
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');

// Cart Routes
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/sidebar', [CartController::class, 'index'])->name('cart.sidebar');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/place-order', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::post('/product/{id}/review', [ProductController::class, 'storeReview'])->name('products.review');

// --- AUTHENTICATION ROUTES ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- DUMMY ADMIN ROUTE (Để test chuyển hướng) ---
Route::get('/admin/dashboard', function() {
    return "<h1>Welcome Admin! This is the Dashboard.</h1><a href='/'>Go Home</a>";
})->name('admin.dashboard');