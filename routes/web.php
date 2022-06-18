<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;

Route::get('/', function() {
    return view('index');
});

Route::get('/menu', function() {
    $products = Product::all();
    return view('menu', ['products' => $products]);
});

Route::get('/request', function(Request $request) {
    $customer = Customer::where('ip_address', '=', $request->ip())->first();
    if($customer && Customer::alreadyRequest($customer->id))
    {
        Session::flash('error', 'Não é permitido fazer 2 ou mais pedidos ao mesmo tempo');
        return redirect('/');   
    }

    $products = Product::all();
    return view('request', ['products' => $products]);
});
