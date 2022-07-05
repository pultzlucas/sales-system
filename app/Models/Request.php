<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class Request extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'state', 'actived'];

    static function getFullInfo($id)
    {
        $request = Request::findOrFail($id);
        $request_products = Product::getProductsOfRequest($id);
        $total_price = array_reduce($request_products, function($total, $item) {return $total + $item->price;}, 0.00);

        $request->items = $request_products;
        $request->total_price = $total_price;

        return $request;
    }

    static function getAllFullInfo()
    {
        $requests = Request::all();
        $requests_full_info = [];

        foreach($requests as $req) {
            array_push($requests_full_info, Request::getFullInfo($req->id));
        }

        return $requests_full_info;
    }

    static function getAllFullInfoByState($state)
    {
        $requests = Request::getAllFullInfo();
        $state_requests = [];
        foreach($requests as $req) {
            if($req->state === $state) {
                array_push($state_requests, $req);
            }
        }
        return $state_requests;
    }
}
