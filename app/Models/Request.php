<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Request extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id'];

    static function getFullInfo($id)
    {
        $request = Request::findOrFail($id);
        $request_products = DB::select("SELECT prod.description, prod.price FROM products AS prod
            JOIN request_products AS rp ON rp.product_id=prod.id 
            WHERE rp.request_id=$id");
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
            $request_products = DB::select("SELECT prod.description, prod.price FROM products AS prod
                JOIN request_products AS rp ON rp.product_id=prod.id 
                WHERE rp.request_id=$req->id");
            $total_price = array_reduce($request_products, function($total, $item) {return $total + $item->price;}, 0.00);

            $req->items = $request_products;
            $req->total_price = $total_price;
            array_push($requests_full_info, $req);
        }

        return $requests_full_info;
    }

    static function getAllFullInfoByState($state)
    {
        $requests = Request::getAllFullInfo();
        return array_filter($requests, function($req) use ($state) {
            return $req->state === $state;
        });
    }
}
