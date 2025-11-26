<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Trỏ vào file index nằm trong thư mục pages/home
    return view('pages.home.index'); 
});