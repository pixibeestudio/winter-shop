<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    // Trỏ vào file index nằm trong thư mục pages/home
    return view('pages.home.index'); 
});

// Route hiển thị chi tiết sản phẩm
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');