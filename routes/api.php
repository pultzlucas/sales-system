<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RequestProductController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'get']);

Route::get('/requests', [RequestController::class, 'index']);
Route::get('/requests/{id}', [RequestController::class, 'get']);
Route::post('/requests', [RequestController::class, 'store']);
Route::put('/requests', [RequestController::class, 'update']);
Route::delete('/requests/{id}', [RequestController::class, 'destroy']);

Route::post('/request_products', [RequestProductController::class, 'store']);