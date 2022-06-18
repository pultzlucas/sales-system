<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestProduct;

class RequestProductController extends Controller
{
    function store(Request $request)
    {
        $request->validate([
            'request_id' => 'required',
            'product_id' => 'required'
        ]);
        
        return RequestProduct::create([
            'request_id' => $request->request_id,
            'product_id' => $request->product_id
        ]);
    }
}
