<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RequestProductController;
use App\Http\Controllers\AuthController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'get']);

Route::get('/requests', [RequestController::class, 'index']);
Route::get('/requests/{id}', [RequestController::class, 'get']);
Route::get('/requests/state/{state}', [RequestController::class, 'getByState']);
Route::post('/requests', [RequestController::class, 'store']);
Route::put('/requests/{id}', [RequestController::class, 'update']);
Route::delete('/requests/{id}', [RequestController::class, 'destroy']);

Route::post('/request_products', [RequestProductController::class, 'store']);
Route::post('/admin/request_products', [RequestProductController::class, 'store']);

Route::post('/admin/requests', [RequestController::class, 'adminStore']);

//AUTH
Route::post('/login', [AuthController::class, 'login']);