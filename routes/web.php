<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ShopController;

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