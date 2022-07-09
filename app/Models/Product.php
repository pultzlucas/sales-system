<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['stock'];
    public $timestamps = false;
    
    static function getProductsOfRequest($request_id)
    {
        return DB::select("SELECT prod.name, prod.price FROM products AS prod
        JOIN request_products AS rp ON rp.product_id=prod.id 
        WHERE rp.request_id=$request_id");
    }
}
