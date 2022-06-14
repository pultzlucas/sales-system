<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    function index()
    {
        return Product::all();
    }

    function get($id)
    {
        return Product::findOrFail($id);
    }
}
