<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Request as RequestModel;
use Illuminate\Support\Facades\Session;

Route::get('/', function(Request $request) {
    return view('index');
});

Route::get('/dashboard', function(Request $request) {
    $cpf = $request->session()->get('CUSTOMER_CPF');
    $customer = Customer::getByCpf($cpf);

    if(!$customer) {
        return view('dashboard', ['request_info' => null]);
    }
    
    $request = Customer::getActivedRequest($customer->id);
    
    if(!$request)
    {
        return view('dashboard', ['request_info' => null]);
    }

    return view('dashboard', [
        'request_info' => RequestModel::getFullInfo($request->id)
    ]);
});

Route::get('/menu', function() {
    $products = Product::all();
    return view('menu', ['products' => $products]);
});

Route::get('/request', function(Request $request) {
    $customer = Customer::getByCpf($request->cookie('CUSTOMER_CPF'));
    if($customer && Customer::alreadyRequest($customer->id))
    {
        Session::flash('error', 'Não é permitido fazer 2 ou mais pedidos ao mesmo tempo');
        return redirect('/dashboard');   
    }
    
    $products = Product::all();
    return view('request', ['products' => $products]);
});

Route::get('/request_history', function(Request $request) {
    $cpf = $request->session()->get('CUSTOMER_CPF');
    $customer = Customer::getByCpf($cpf);

    if(!$customer) {
        return view('request-history', ['requests' => null]);
    }

    $requests = array_map(function($req) {
        return RequestModel::getFullInfo($req['id']);
    }, array_reverse(Customer::getAllRequests($customer->id)->toArray()));

    return view('request-history', ['requests' => $requests]);
});

// ADMIN

Route::get('/admin', function() {
    return view('admin');
});

Route::get('/admin/request', function() {
    $products = Product::all();
    return view('admin-request', ['products' => $products]);
});
