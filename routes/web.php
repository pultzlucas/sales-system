<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

use App\Models\Product;

Route::get('/', function() {
    return view('index');
});

Route::get('/menu', function() {
    $products = Product::all();
    return view('menu', ['products' => $products]);
});

Route::get('/request', function() {
    $products = Product::all();
    return view('request', ['products' => $products]);
});
